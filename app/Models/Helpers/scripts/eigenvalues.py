import sys
import json
from scipy import linalg as la

# Load the data that PHP sent us
try:
    A = json.loads(sys.argv[1])
except:
    print("ERROR")
    sys.exit(1)

eigenvalues, eigenvectors = la.eig(A)

print(','.join(map(str, eigenvalues)))
