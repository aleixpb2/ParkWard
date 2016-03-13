import sys
import cv2
import numpy as np


# Read values
x1 = int(sys.argv[1])
y1 = int(sys.argv[2])
x2 = int(sys.argv[3])
y2 = int(sys.argv[4])
x3 = int(sys.argv[5])
y3 = int(sys.argv[6])
x4 = int(sys.argv[7])
y4 = int(sys.argv[8])
img_name = sys.argv[9]

# Calculate the chustas
img = cv2.imread(img_name)
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
"""
644 536 879 531 1091 889 724 905 facil.jpg
rect = np.array([
	[644,536],
	[879,531],
	[1091,889],
	[724,905]], dtype = "float32")
"""	
"""
398 540 646 539 722 908 335 924 facil.jpg
rect = np.array([
	[398,540],
	[646,539],
	[722,908],
	[335,924]], dtype = "float32")

"""
rect = np.array([
	[x1,y1],
	[x2,y2],
	[x3,y3],
	[x4,y4]], dtype = "float32")

(tl, tr, br, bl) = rect

widthA = np.sqrt(((br[0] - bl[0]) ** 2) + ((br[1] - bl[1]) ** 2))
widthB = np.sqrt(((tr[0] - tl[0]) ** 2) + ((tr[1] - tl[1]) ** 2))
maxWidth = max(int(widthA), int(widthB))

heightA = np.sqrt(((tr[0] - br[0]) ** 2) + ((tr[1] - br[1]) ** 2))
heightB = np.sqrt(((tl[0] - bl[0]) ** 2) + ((tl[1] - bl[1]) ** 2))
maxHeight = max(int(heightA), int(heightB))

"""for (x,y) in rect:
	cv2.circle(img, (x,y), 10, (255,0,0))

cv2.imwrite('esteve.jpg',img)"""
	
# now that we have the dimensions of the new image, construct
# the set of destination points to obtain a "birds eye view",
# (i.e. top-down view) of the image, again specifying points
# in the top-left, top-right, bottom-right, and bottom-left
# order
dst = np.array([
	[0, 0],
	[maxWidth - 1, 0],
	[maxWidth - 1, maxHeight - 1],
	[0, maxHeight - 1]], dtype = "float32")

# compute the perspective transform matrix and then apply it
M = cv2.getPerspectiveTransform(rect, dst)
img = cv2.warpPerspective(img, M, (maxWidth, maxHeight))

scolor=475
sspace=150
percentile=10

image_name='img_'+str(scolor)+'_'+str(sspace)
blurred = cv2.bilateralFilter(img,9,scolor,sspace)
edge = cv2.Canny(blurred,100,100)
cv2.imwrite('imgb.jpg',blurred)
cv2.imwrite('imge.jpg',edge)
cv2.imwrite('wast.jpg',img)

histt = cv2.calcHist([blurred],[0],None,[256],[0,256])
hist=[]
for [x] in histt: hist=hist+[int(x)]

hist = sorted(hist)
total=0
hist_plot=np.zeros((256,256))
end=int(256-256*percentile/100)
for x in range (0,end):
	total=total+hist[x]
	size=int(hist[x]/256)
	for y in range (0,256-size):
		hist_plot[y][x]=255

for x in range (end,256):
	size=int(hist[x]/256)
	for y in range (0,256-size):
		hist_plot[y][x]=255
	for y in range (256-size,256):
		hist_plot[y][x]=120


cv2.imwrite('hist.jpg',hist_plot)
#print total
w,h = blurred.shape[:2]
#print w*h
res=(100*total)/(w*h)
cv2.waitKey(0)
cv2.destroyAllWindows()

if res>15:
	state=1
else:
	if res>12:
		state=2
	else:
		state=0


# Return values
print state
# 0->free
# 1->occupied
# 2->unknown

# Important: do not print anything else or I'll get that shit to the DB!