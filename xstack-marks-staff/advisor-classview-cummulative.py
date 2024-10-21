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
                             'GeneratedClassAdvisorCumMMReport_' + random_string(8) + '.xlsx').replace('\\\\', '/')
workbook = xlsxwriter.Workbook(workbook_name)

file_head_format = workbook.add_format({
    'align': 'left',
    'valign': 'vleft',
    'fg_color': '#6201ED',
    'font_color': 'white'})

column_head_format = workbook.add_format({
    'border': 1,
    'align': 'center',
    'valign': 'vleft',
    'fg_color': '#343333',
    'font_color': 'white'})


def mysql_connection(subject_code, department, semester, exam):
    global cnx, mtable
    try:
        cursor = cnx.cursor()
        if exam == "all":
            query = "SHOW COLUMNS FROM `" + mtable.strip("'")+"`;"
        else:
            query = "SHOW COLUMNS FROM `" + \
                mtable.strip("'")+"` WHERE field LIKE '"+exam+"%';"
        cursor.execute(query)
        col_name = []
        for col in cursor:
            if col[0] != "register_no":
                col_name.append(col[0])
        col_name = "`,`".join(sorted(col_name))
        cursor.close()
        exams = []
        for cname in col_name.split("`,`"):
            if cname.split("_")[0] not in exams:
                exams.append(cname.split("_")[0])
        query = "SELECT DISTINCT full_name,subject_name FROM users JOIN time_table ON users.username=time_table.staff_name WHERE subCode_dept_sem='" + \
            mtable.strip("'")[3:]+"' ;"
        sub_details = cnx.cursor()
        sub_details.execute(query)
        for details in sub_details:
            sub_det = details
        sub_details.close()

        worksheet = workbook.add_worksheet(mtable.strip("'")[3:].upper())
        # prepare report template here
        prepare_workbook(worksheet, subject_code, department,
                         semester, sub_det, col_name, exams)
        row_no = 7
        user_cursor = cnx.cursor()
        if (col_name == ""):
            query = "SELECT T.register_no ,full_name FROM `" + \
                mtable.strip("'") + "` AS T JOIN `users` USING(register_no)"
        else:
            query = "SELECT T.register_no ,full_name, `"+col_name + "` FROM `" + \
                mtable.strip("'") + "` AS T JOIN `users` USING(register_no)"
        user_cursor.execute(query)
        for row in user_cursor:
            worksheet.write(row_no, 0, str(row[0]))
            worksheet.write_row(row_no, 1, row[1:])
            row_no += 1
        user_cursor.close()
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("\"db-fetch-error\"")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("\"db-fetch-error\"")
        else:
            print(err)


def prepare_workbook(worksheet, subject_code, department, semester, sub_det, col_name, exams):
    global workbook, file_head_format, column_head_format

    worksheet.merge_range('A1:BZ1', 'Marks Module : Class Reports - Cummulative - Loyola-ICAM College of Engineering and Technology',
                          file_head_format)

    if semester == 1 or semester == 2:
        year = "I"
    elif semester == 3 or semester == 4:
        year = "II"
    elif semester == 5 or semester == 6:
        year = "III"
    elif semester == 7 or semester == 8:
        year = "IV"
    else:
        year = "Unknown"

    worksheet.merge_range('A2:BZ2', "Subject Code: " + subject_code + "| Year: " + year + "| Semester: " + str(semester),
                          file_head_format)

    if department == "DIT":
        dept = "Information Technology"
    elif department == "DCSE":
        dept = "Computer Science and Engineering"
    elif department == "DEEE":
        dept = "Electrical and Electronics Engineering"
    elif department == "DECE":
        dept = "Electronics and Communication Engineering"
    elif department == "DMEA":
        dept = "Mechanical Engineering - A"
    elif department == "DMEB":
        dept = "Mechanical Engineering - B"
    else:
        dept = "Unknown"

    worksheet.merge_range('A3:BZ3', 'Department of ' + dept, file_head_format)

    worksheet.merge_range('A4:BZ4', 'Staff Name : '+sub_det[0]+' | Subject Name : ' +
                          sub_det[1], file_head_format)

    worksheet.merge_range('A6:B6', 'Student Details', column_head_format)

    worksheet.write('A7', 'Register No', column_head_format)

    worksheet.write('B7', 'Name of the student', column_head_format)
    worksheet.set_column(0, 0, 14)
    worksheet.set_column(1, 1, 20)
    colors = ["#13152E", "#29343C", "#013A52", "#231509", "#152E13"]
    column_no = 2
    color = 0
    start = 0
    if (col_name != ""):
        for ename in exams:
            if color == 5:
                color = 0
            exam_head_format = workbook.add_format({
                'border': 1,
                'align': 'center',
                'valign': 'vleft',
                'fg_color': colors[color],
                'font_color': 'white'})
            cell_len = sum(1 for exam in col_name.split(
                "`,`") if ename in exam)
            end = start+cell_len
            if cell_len > 1:
                worksheet.merge_range(
                    5, column_no, 5, column_no + cell_len-1, ename.upper(), exam_head_format)
            else:
                worksheet.write(5, column_no, ename.upper(), exam_head_format)
            for column in col_name.split("`,`")[start:end]:
                worksheet.write(6, column_no, column.split(
                    "_")[1].upper()+" ("+column.split("_")[2]+")", exam_head_format)
                worksheet.set_column(6, column_no, 20)
                column_no += 1
            color += 1
            start = end


tables = [tname for tname in sys.argv[1].split(',')]
for i in range(1, len(tables)):
    mtable = tables[i].strip('"[]\'').lower()
    subject_code = mtable.split('_')[1].upper()
    department = mtable.split('_')[2].upper()
    semester = int(mtable.split('_')[3].rstrip("'"))
    exam = sys.argv[2].strip("'")

    mysql_connection(subject_code, department, semester, exam)
try:
    cnx.close()
    workbook.close()
    print('\"' + workbook_name + '\"')
except:
    print("\"error\"")
