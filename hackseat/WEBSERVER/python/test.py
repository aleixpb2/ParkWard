import numpy as np
import sys
import cv2

img_name = 'facil.jpg'

img = cv2.imread(img_name)
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

"""
rect = np.array([
	[644,536],
	[879,531],
	[1091,889],
	[724,905]], dtype = "float32")

"""
rect = np.array([
	[398,540],
	[646,539],
	[722,908],
	[335,924]], dtype = "float32")
folder='car'

"""
rect = np.array([
	[55,269],
	[730,258],
	[745,309],
	[53,324]], dtype = "float32")"""

(tl, tr, br, bl) = rect

widthA = np.sqrt(((br[0] - bl[0]) ** 2) + ((br[1] - bl[1]) ** 2))
widthB = np.sqrt(((tr[0] - tl[0]) ** 2) + ((tr[1] - tl[1]) ** 2))
maxWidth = max(int(widthA), int(widthB))

heightA = np.sqrt(((tr[0] - br[0]) ** 2) + ((tr[1] - br[1]) ** 2))
heightB = np.sqrt(((tl[0] - bl[0]) ** 2) + ((tl[1] - bl[1]) ** 2))
maxHeight = max(int(heightA), int(heightB))
"""
for i in range(0,4):
	j=(i+1)%4
	(xi,yi)=rect[i]
	(xj,yj)=rect[j]
	cv2.line(img, (xi,yi), (xj, yj), (0,0,255),3)

cv2.imwrite(folder+'/lines.jpg',img)
"""	
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

blurred = cv2.bilateralFilter(img,9,scolor,sspace)
edge = cv2.Canny(blurred,100,100)
cv2.imwrite(folder+'/imgb.jpg',blurred)
cv2.imwrite(folder+'/imge.jpg',edge)

histt = cv2.calcHist([blurred],[0],None,[256],[0,256])
hist=[]
for [x] in histt: hist=hist+[int(x)]

hist = sorted(hist)
total=10
hist_plot=np.zeros((256,256))
end=int(256-256*percentile/100)
for x in range (0,end):
	total=total+hist[x]
	size=int(hist[x]/50)
	for y in range (0,256-size):
		hist_plot[y][x]=255

for x in range (end,256):
	size=int(hist[x]/50)
	for y in range (0,256-size):
		hist_plot[y][x]=255
	for y in range (256-size,256):
		hist_plot[y][x]=120

cv2.imwrite(folder+'/histCut.jpg',hist_plot)
print total
w,h = blurred.shape[:2]
print w*h
print (100*total)/(w*h)
cv2.waitKey(0)
cv2.destroyAllWindows()
