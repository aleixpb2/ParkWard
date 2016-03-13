import numpy as np
import cv2

car1_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/cas1.xml')
car2_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/cas2.xml')
car3_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/cas3.xml')
car4_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/cas4.xml')
checkcas_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/checkcas.xml')

#INPUTS
filename = 'arnau'
#rejectLevels = 1.5  # BEST -> 1.35,  MINIMUM -> 1.1
levelWeights = 4 # BEST -> 3, RANGE 2-4 

for i in np.linspace(1.1, 2, 50):
	rejectLevels = i;
	img = cv2.imread(filename + '.jpg')

	gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

	cars = car1_cascade.detectMultiScale(gray, rejectLevels, levelWeights)  
	for (x,y,w,h) in cars:
		cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
		
	cars = car2_cascade.detectMultiScale(gray, rejectLevels, levelWeights)
	for (x,y,w,h) in cars:
		cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)

	cars = car3_cascade.detectMultiScale(gray, rejectLevels, levelWeights)
	for (x,y,w,h) in cars:
		cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
		
	cars = car4_cascade.detectMultiScale(gray, rejectLevels, levelWeights)
	for (x,y,w,h) in cars:
		cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
		
	cars = checkcas_cascade.detectMultiScale(gray, rejectLevels, levelWeights)
	for (x,y,w,h) in cars:
		cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
		
	cv2.imwrite( './ProvesFor/' + filename + '_' +  str(rejectLevels) + '_' + str(levelWeights) + '.jpg',img)

cv2.waitKey(0)
cv2.destroyAllWindows()
