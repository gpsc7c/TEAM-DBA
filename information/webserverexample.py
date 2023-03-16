#-------------------------------------------------------------------------------
# Name:        module1
# Purpose:
#
# Author:      nvfer
#
# Created:     09/03/2023
# Copyright:   (c) nvfer 2023
# Licence:     <your licence>
#-------------------------------------------------------------------------------

#def main():
#    pass

#if __name__ == '__main__':
#    main()

#import socket module
from socket import *
import sys
import os
serverPort=36789
serverSocket = socket(AF_INET, SOCK_STREAM)
#Prepare a server socket
serverSocket.bind(('',serverPort))
serverSocket.listen(1)
print ('the web server is up on port:',serverPort)

while True:
     #Establish the connection
     print('The server is ready to receive')
     connectionSocket, addr = serverSocket.accept()

     try:

         message = connectionSocket.recv(1024)
         filename = message.split()[1]

         f = open(filename[1:])
         outputData = f.read()
         #Send one HTTP header line into socket

         connectionSocket.send('HTTP/1.1 200 OK\n\n'.encode())
         #Send the content of the requested file to the client
         #connectionSocket.send(outputData.encode())
         for i in range(0, len(outputData)):
           connectionSocket.send(outputData[i].encode())

         connectionSocket.send("\r\n".encode())

         connectionSocket.close()
     except IOError:
         #Send response message for file not found
         connectionSocket.send('HTTP/1.1 404 Not Found\n\n'.encode())
         connectionSocket.send('404 Not Found\n\n'.encode())
         #Close client socket
         connectionSocket.close()
serverSocket.close()
sys.exit()