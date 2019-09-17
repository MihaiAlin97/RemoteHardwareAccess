#!/usr/bin/python
# -*- coding: latin-1 -*-
# example getPSUData.py  -p COM81 -c volt200 (COM<port number>)
#C:\xampp\htdocs\PSUData\getPSUData.py  -p COM64 -c volt120

import sys, getopt
import serial

def main(argv):
   port = ''
   command = ''
   try:
      opts, args = getopt.getopt(argv,"hp:c:",["port=","command="])
   except getopt.GetoptError:
      print 'test.py -p <port> -c <command>'
      sys.exit(2)
   for opt, arg in opts:
      if opt == '-h':
         print 'test.py -p <port> -c <command>'
         sys.exit()
      elif opt in ("-p", "--port"):
         port = arg
      elif opt in ("-c", "--command"):
         command = arg
   
   #try: 
   ser = serial.Serial(port, 9600,timeout=None, parity=serial.PARITY_NONE, stopbits=serial.STOPBITS_ONE, bytesize=serial.EIGHTBITS)
   #ser.open()
   #set sourceOn  -p COM81 -c on
   if command == "on":
      ser.write("\rSOUT000\r")
   #set sourceOff  -p COM81 -c off
   elif command == "off":
      ser.write("\rSOUT001\r")
   #set sourceVoltage  -p COM81 -c volt200 (for 20V/ volt<number*10>)
   elif command[:4] == "volt":
      ser.write("\rVOLT00".strip()+command[4:]+"\r")
   #display sourceVoltage(and ampere)  -p COM81 -c dis
   elif command == "dis":
      ser.write("\rGETS00\r")
      x = ser.read(10)
      file = open("C:\\xampp\\htdocs\\PSUData\\output"+port+".txt","w") 
      file.write(x)  
      file.close() 
	  
 #  ser.close()
#   except:
#		sys.exit("Error connecting device")
#   ser.write("\rGETS00\r")
#   x = ser.read()

if __name__ == "__main__":
   main(sys.argv[1:])