import numpy as np
import cv2

car1_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/cas1.xml')
car2_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/cas2.xml')
car3_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/cas3.xml')
car4_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/cas4.xml')
checkcas_cascade = cv2.CascadeClassifier('CAR-DETECTION-master/checkcas.xml')

img = cv2.imread('facil.jpg')
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

# cars = car1_cascade.detectMultiScale(gray, 1.1, 2)
# for (x,y,w,h) in cars:
	# cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
	
# cars = car2_cascade.detectMultiScale(gray, 1.1, 2)
# for (x,y,w,h) in cars:
	# cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)

# cars = car3_cascade.detectMultiScale(gray, 1.1, 2)
# for (x,y,w,h) in cars:
	# cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
	
# cars = car4_cascade.detectMultiScale(gray, 1.1, 2)
# for (x,y,w,h) in cars:
	# cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
	
cars = checkcas_cascade.detectMultiScale(gray, 1.1, 2)
for (x,y,w,h) in cars:
	cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
	
cv2.imwrite('img_3.jpg',img)
cv2.waitKey(0)
cv2.destroyAllWindows()
