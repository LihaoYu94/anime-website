

import pickle 
import numpy as np 
import csv
import re

genre_lst =  ['Drama', 'Romance', 'School', 'Supernatural', 
				'Action', 'Adventure', 'Fantasy', 'Magic', 'Military', 'Shounen',
				'Comedy', 'Historical', 'Parody', 'Samurai', 'Sci-Fi', 
				'Thriller', 'Sports', 'Super Power', 'Slice of Life', 'Mecha'
				'Music', 'Vampire', 'Shoujo', 'Mystery', 'Ecchi', 'Police', 'Psychological',
				'Seinen', 'Space', 'Josei', 'Harem', 'Game']

data_tbl = np.zeros([12294, 31])
label_tbl = np.zeros(12294)

with open('anime.csv', 'r') as csvfile:
	i = 0
	for line in csvfile:
		if i > 0:
			each_line = line.strip().split(',')
			label = each_line[0]


			label_tbl[i - 1] = str(label)

			for j in range(31):
				if genre_lst[j] in str(each_line):
					data_tbl[i - 1, j] = 1

		i += 1

np.save('./knn_data', data_tbl)
np.save('./knn_label', label_tbl)