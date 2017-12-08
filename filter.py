import numpy as np 
import sys
import math
import operator



def main():
	# out = "hello"
	# print(out)
	# return out
	message = sys.argv[1]
	spam_word_list = ["anal","anus","arse","ass","ballsack","balls","bastard","bitch","biatch","bloody",
						"blowjob","blow job","bollock","bollok","boner","boob","bugger","bum","butt",
						"buttplug","clitoris","cock","coon","crap","cunt","damn","dick","dildo","dyke","fag","feck",
						"fellate","fellatio","felching","fuck","f u c k","fudgepacker","fudge packer","flange","Goddamn",
						"God damn","hell","homo","jerk","jizz","knobend","knob end","labia", 
						"lmao","lmfao","muff","nigger","nigga","omg","penis","piss","poop","prick","pube","pussy","queer",
						"scrotum","sex","shit","s hit","sh1t","slut","smegma","spunk","tit","tosser","turd","twat","vagina","wank","whore"]

	
	for word in message.split():
		if word in spam_word_list:
			print("****")
			print("hdhhd")
			return 
	print(message)
	print("sdodso")	
	return	

if __name__ == '__main__':
	main()


	 