# !D:/home/python364x86/python.exe

# above line is the Python interpreter's path

# import sys

# import mysql.connector
# from mysql.connector import errorcode

# from local_config import config


# def mysql_connection():
#     global username, day, hour, date, response_list

#     try:
#         cnx = mysql.connector.connect(**config)

#         cursor = cnx.cursor()
#         query = "WRITE SQL HERE"
#         cursor.execute(query)

#         for row in cursor:
#             print(row)
#         cursor.close()

#         cnx.close()

#     except mysql.connector.Error as err:
#         if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
#             print("\"db-fetch-error\"")
#         elif err.errno == errorcode.ER_BAD_DB_ERROR:
#             print("\"db-fetch-error\"")
#         else:
#             print(err)


# # add more cmd line argsa here
# username = sys.argv[1]
# hour = int(sys.argv[2])

# # call method
# mysql_connection()

print("Hello World")
