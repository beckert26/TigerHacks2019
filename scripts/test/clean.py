import fileinput
import os
directory = '/var/www/html/scripts/test'
def clean(filename):
clean_lines = []
with open(filename, "r") as f:
lines = f.readlines()
clean_lines = [l.strip() for l in lines if l.strip()]
with open(filename, "w") as f:
f.writelines('\n'.join(clean_lines))
for root, dirs, files in os.walk(directory):
for filename in files:
clean(os.path.join(root,filename))