import cv2
import urllib
import numpy as numpy
import os

lines = ''
with open('images.in') as f:
    lines = f.readlines()


def url_to_image(url):
	resp = urllib.urlopen(url)
	image = numpy.asarray(bytearray(resp.read()), dtype="uint8")
	image = cv2.imdecode(image, cv2.IMREAD_COLOR)
	return image

faceDetect = cv2.CascadeClassifier('lbpcascade_animeface.xml')

sampleNum = 0
#lines = lines.splitlines()
for val in lines:
	try:
		img = url_to_image(val)
		gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
		gray = cv2.equalizeHist(gray)
		faces = faceDetect.detectMultiScale(gray, scaleFactor = 1.1, minSize = (24, 24))
		for(x,y,w,h) in faces:
			sampleNum = sampleNum + 1
			filename = val.strip()
			filename = filename.replace("\\", "forward")
			filename = filename.replace("/", "backward")
			filename = filename.replace(":", "colon")
			filename = filename.replace("?", "where")
			filename = filename.replace(".", "dot")
			filename = filename.replace("=", "equals")
			cv2.imwrite("dataSet/" + str(sampleNum) +  filename + ".jpg", gray[y:y+h,x:x+w])
			if sampleNum % 50 == 0:
				print("Done of " + str(sampleNum) + "\n")
	except:
		print ("Error with " + val + "\n")
print("done of all")
