#!/usr/bin/python
import cgi, cgitb
import MySQLdb

webForm = cgi.FieldStorage()

username = webForm.getvalue('UserName')
mypass = webForm.getvalue('MyPass')

db= MySQLdb.connect("localhost","mcdonout1","a4o81x","mcdonout1_db")

myCursor = db.cursor()

sql = "INSERT INTO UserPass VALUES ('%s','%s');" %(username,mypass)

try:
        myCursor.execute(sql)
        db.commit()
except:
        db.rollback()
db.close()

print "Content-type:text/html\r\n\r\n"
print "<html>"
print "<head>"
print "<title> REGISTRATION FORM</title>"
print "<head>"
print "<body>"
print "<h2> Congratulations! You Have Successfully Register With UserName = %s </h2>" %(username)
print "</body>"
print "</html>"
