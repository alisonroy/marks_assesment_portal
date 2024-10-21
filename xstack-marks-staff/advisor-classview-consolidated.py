#!D:/home/python364x86/python.exe
import random
import string
import sys
import os

from local_config import config

import mysql.connector
import xlsxwriter
from mysql.connector import errorcode

cnx = mysql.connector.connect(**config)


def random_string(string_length):
    letters = string.ascii_lowercase
    return ''.join(random.choice(letters) for i in range(string_length))


dirname = os.path.dirname(__file__)
workbook_name = os.path.join(os.path.join(dirname, "mm-xport-generated"),
                             'GeneratedClassAdvisorConMMReport_' + random_string(8) + '.xlsx').replace('\\\\', '/')
workbook = xlsxwriter.Workbook(workbook_name)

file_head_format = workbook.add_format({
    'align': 'left',
    'valign': 'vleft',
    'fg_color': '#6201ED',
    'font_color': 'white'})

column_head_format = workbook.add_format({
    'border': 1,
    'align': 'center',
    'valign': 'vcenter',
    'fg_color': '#343333',
    'font_color': 'white'})


def mysql_connection(subject_code, department, semester, exam, stu_details):
    global cnx, mtable, subject_det
    try:
        worksheet = workbook.add_worksheet(exam.replace("-", " ").upper())
        # prepare report template here
        prepare_workbook(worksheet, subject_code, department,
                         semester, subject_det, exam, stu_details)
        col_no = 2
        for table in mtable:
            cursor = cnx.cursor()
            query = "SHOW COLUMNS FROM `" + \
                table.strip("'")+"` WHERE field LIKE '%" + exam + \
                "_internal%' OR field LIKE '%" + exam+"_external%';"
            cursor.execute(query)
            col_name = []
            for col in cursor:
                col_name.append(col[0])
            if len(col_name) > 0:
                col_name = "`,`".join(sorted(col_name, reverse=True))
                cursor.close()
                user_cursor = cnx.cursor()
                query = "SELECT register_no, `"+col_name + \
                    "` FROM `" + table.strip("'")+"` ;"
                user_cursor.execute(query)
                col_name = col_name.split("`,`")
                if(len(col_name) == 2):
                    for row in user_cursor:
                        row_no = [ind[0]
                                  for ind in stu_details].index(row[0])+8
                        worksheet.write(row_no, col_no, row[1])
                        worksheet.write(row_no, col_no+1, row[2])
                        worksheet.write(row_no, col_no+2, row[1]+row[2])
                    col_no += 3
                if(len(col_name) == 1):
                    if(col_name[0].split("_")[1] == "external"):
                        col_inc = 1
                    if(col_name[0].split("_")[1] == "internal"):
                        col_inc = 2
                    for row in user_cursor:
                        row_no = [ind[0]
                                  for ind in stu_details].index(row[0])+8
                        worksheet.write(row_no, col_no, row[1])
                        worksheet.write(row_no, col_no+col_inc, row[1])
                    col_no += 3
                user_cursor.close()
            else:
                col_no += 3

    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("\"db-fetch-error\"")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("\"db-fetch-error\"")
        else:
            print(err)


def prepare_workbook(worksheet, subject_code, department, semester, subject_det, exam, stu_details):
    global workbook, file_head_format, column_head_format

    worksheet.merge_range('A1:BZ1', 'Marks Module : Class Reports - Consolidated - Loyola-ICAM College of Engineering and Technology',
                          file_head_format)

    if semester[0] == 1 or semester[0] == 2:
        year = "I"
    elif semester[0] == 3 or semester[0] == 4:
        year = "II"
    elif semester[0] == 5 or semester[0] == 6:
        year = "III"
    elif semester[0] == 7 or semester[0] == 8:
        year = "IV"
    else:
        year = "Unknown"

    worksheet.merge_range('A2:BZ2', "Year: " + year + "| Semester: " + str(
        semester[0])+" | Exam: "+exam.strip("'").replace("-", " ").upper(), file_head_format)

    if department[0] == "DIT":
        dept = "Information Technology"
    elif department[0] == "DCSE":
        dept = "Computer Science and Engineering"
    elif department[0] == "DEEE":
        dept = "Electrical and Electronics Engineering"
    elif department[0] == "DECE":
        dept = "Electronics and Communication Engineering"
    elif department[0] == "DMEA":
        dept = "Mechanical Engineering - A"
    elif department[0] == "DMEB":
        dept = "Mechanical Engineering - B"
    else:
        dept = "Unknown"

    worksheet.merge_range('A3:BZ3', 'Department of ' + dept, file_head_format)

    worksheet.merge_range('A5:B7', 'Student Details', column_head_format)

    worksheet.write('A8', 'Register No', column_head_format)

    worksheet.write('B8', 'Name of the student', column_head_format)
    worksheet.set_column(0, 0, 14)
    worksheet.set_column(1, 1, 20)
    colors = ["#13152E", "#29343C", "#013A52", "#231509", "#152E13"]
    column_no = 2
    color = 0
    for subCode, subDet in zip(subject_code, subject_det):
        head = ["Internal", "External", "Total"]
        if color == 5:
            color = 0
        sub_head_format = workbook.add_format(
            {'border': 1,
             'align': 'center',
             'valign': 'vcenter',
             'fg_color': colors[color],
             'font_color': 'white'})
        worksheet.merge_range(4, column_no, 4, column_no +
                              2, subDet[0], sub_head_format)
        worksheet.merge_range(5, column_no, 5, column_no +
                              2, subDet[1], sub_head_format)
        worksheet.merge_range(6, column_no, 6, column_no +
                              2, subCode, sub_head_format)
        worksheet.write_row(7, column_no, head, sub_head_format)
        column_no += 3
        color += 1
    row_no = 8
    for student in stu_details:
        worksheet.write(row_no, 0, str(student[0]))
        worksheet.write(row_no, 1, student[1])
        row_no += 1


tables = [tname for tname in sys.argv[1].split(',')]
subject_det = []
subject_code = []
department = []
semester = []
mtable = []
sub_details = cnx.cursor()
for i in range(1, len(tables)):
    mtable.append(tables[i].strip('"[]\'').lower())
    query = "SELECT DISTINCT full_name,subject_name FROM users JOIN time_table ON users.username=time_table.staff_name WHERE subCode_dept_sem='" + \
            mtable[i-1].strip("'")[3:]+"' ;"
    sub_details.execute(query)
    for details in sub_details:
        subject_det.append(details)
    subject_code.append(mtable[i-1].split('_')[1].upper())
    department.append(mtable[i-1].split('_')[2].upper())
    semester.append(int(mtable[i-1].split('_')[3].rstrip("'")))
sub_details.close()
details = cnx.cursor()
query = "SELECT `register_no`, `full_name` FROM `users` WHERE department='" + \
    department[0]+"' AND semester='" + \
        str(semester[0])+"' AND user_type='student';"
details.execute(query)
stu_details = []
for col in details:
    stu_details.append(col)
details.close()


exams = [ename for ename in sys.argv[2].split(',')]
for i in range(1, len(exams)):
    exam = exams[i].replace(" ", "-").strip('"[]\'').lower()
    mysql_connection(subject_code, department, semester, exam, stu_details)

try:
    cnx.close()
    workbook.close()
    print('\"' + workbook_name + '\"')
except:
    print("\"error\"")
