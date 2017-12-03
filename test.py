import numpy as np 
import sys
import math
import operator





def euclideanDistance(instance1, instance2, length):
	distance = 0
	for x in range(length):
		distance += pow((instance1[x] - instance2[x]), 2)
	return math.sqrt(distance)

def main():
	k = 3
	test_label = sys.argv[1]

	data_tbl = np.load('./knn_data.npy')
	label_tbl = np.load('./knn_label.npy')


	line = np.argwhere(label_tbl[:] == float(test_label))
	label_tbl = np.delete(label_tbl, line[0], 0)


	test_data = data_tbl[line[0], :]
	data_tbl = np.delete(data_tbl, line[0], 0)
	distances = []

	for x in range(data_tbl.shape[0]):
		dist = euclideanDistance(test_data.transpose(), data_tbl[x], data_tbl.shape[1])
		distances.append((label_tbl[x], dist))
	distances.sort(key=operator.itemgetter(1))
	neighbors = []
	for x in range(k):
		neighbors.append(distances[x][0])

	results = [int(i) for i in neighbors]

	print(results[0])
	print(results[1])
	print(results[2])

	return results[0]

if __name__ == '__main__':
	main()


