#!/usr/bin/python
import cgi, cgitb
import MySQLdb

webForm = cgi.FieldStorage()

spotname = webForm.getvalue('SpotName')
spottype = webForm.getvalue('SpotType')
spotaddress = webForm.getvalue('SpotAddress')
spotcity = webForm.getvalue('SpotCity')
spotstate = webForm.getvalue('SpotState')
spotZip = webForm.getvalue('SpotZip')




db= MySQLdb.connect("localhost","mcdonout1","a4o81x","mcdonout1_db")

myCursor = db.cursor()



sql = "INSERT INTO Spots (spot_name, type, st-addr, city, state, zip)
 VALUES ('%s','%s','%s','%s','%s','%s');" %(SpotName, SpotType, SpotAddress, SpotCity, SpotState, SpotZip)

try:
        myCursor.execute(sql)
        db.commit()
except:
        db.rollback()
db.close()

print "Content-type:text/html\r\n\r\n"
print "<html>"
print "<head>"
print "<title> New Spot </title>"
print "<head>"
print "<body>"
print "<h2> Congratulations! You Have Successfully Register With UserName = %s </h2>" %(username)
print "</body>"
print "</html>"
