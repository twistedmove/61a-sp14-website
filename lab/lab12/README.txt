NOTES FOR SETTING UP THE LAB TO FUTURE TAs
==========================================

Note:  in order to upload the shakespeare data file to DFS,
you need to first run the following command:
  
  # /home/ff/cs61a/projects/hadoop/hadoop/bin/hadoop dfs -put ~cs61a/lib/shakespeare.txt ../shakespeare

(It appears that the filesystem is cleared periodically)


Note: For some reason, to run some of the commonly-used Unix commands on 
icluster1 (such has mv, rm, etc), you may need to fully specify the 
filepath of the program, like: # /bin/mv myfile.py newmyfile.py
