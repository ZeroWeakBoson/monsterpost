from sympy import *
import sympy as sp
import numpy as np

# define output file
5 file = open(’GR (4 ,4) - Feb27_36864_output .txt ’, ’w’)

# calculate eigenvalues of B matrices for one adinkra
def calculation_Bmatrix_eigenvalue ( L1 , L2 , L3 , L4 ):
10 # Get R matrix
R1 = np . transpose ( L1 )
R2 = np . transpose ( L2 )
R3 = np . transpose ( L3 )
15 R4 = np . transpose ( L4 )

# define m_i, nu_i = mu_i^{−1}
m1 = sp . Symbol (’m’)
20 m2 = sp . Symbol (’m’)
m3 = sp . Symbol (’m’)
m4 = sp . Symbol (’m’)
nu1 = sp . Symbol (’nu ’)
nu2 = sp . Symbol (’nu ’)
25 nu3 = sp . Symbol (’nu ’)
nu4 = sp . Symbol (’nu ’)

# define lifting matrice
P_L_1 = np . diag (( m1 ,1 ,1 ,1))
30 P_L_2 = np . diag ((1 , m2 ,1 ,1))
P_L_3 = np . diag ((1 ,1 , m3 ,1))
P_L_4 = np . diag ((1 ,1 ,1 , m4 ))
P_R_1 = np . diag (( nu1 ,1 ,1 ,1))
P_R_2 = np . diag ((1 , nu2 ,1 ,1))
35 P_R_3 = np . diag ((1 ,1 , nu3 ,1))
P_R_4 = np . diag ((1 ,1 ,1 , nu4 ))

# calculate B1, B2 matrix for 1+4+6+4+1 cases 40 and output their eigenvalues
#B1 = L4∗R3∗L2∗R1
#B2 = R4∗L3∗R2∗L1

# lift zero boson
45 B1_lift0 = np . mat ( L4 )* np . mat ( R3 )* np . mat ( L2 )* np . mat ( R1 )
B2_lift0 = np . mat ( R4 )* np . mat ( L3 )* np . mat ( R2 )* np . mat ( L1 )
file . wr ite (’lift zero boson : \n’)
B1_lift0_eigen1 , B1_lift0_eigen2 , B1_lift0_eigen3 ,
50 B1_lift0_eigen4 , diag1 = calculate_eigenvalues ( B1_lift0 )
B2_lift0_eigen1 , B2_lift0_eigen2 , B2_lift0_eigen3 ,
B2_lift0_eigen4 , diag2 = calculate_eigenvalues ( B2_lift0 )
file . wr ite (’ eigenvalues for B1:’+ ’ ’
+ str ( B1_lift0_eigen1 )+ ’ ’ + str ( B1_lift0_eigen2 )
55 + ’ ’ + str ( B1_lift0_eigen3 )+ ’ ’
+ str ( B1_lift0_eigen4 ) + "\n")
file . wr ite (’ eigenvalues for B2:’+ ’ ’
+ str ( B2_lift0_eigen1 )+ ’ ’ + str ( B2_lift0_eigen2 )
+ ’ ’ + str ( B2_lift0_eigen3 )+ ’ ’
60 + str ( B2_lift0_eigen4 ) + "\n")

#lift i−th boson (i = 1,2,3,4)
f o r i in (1 ,2 ,3 ,4):
65 locals ()[ ’B1_lift ’ + str ( i )] = np . mat ( locals ()
[’P_L_ ’ + str ( i )])* np . mat ( L4 )* np . mat ( R3 )*
np . mat ( locals ()[ ’P_R_ ’ + str ( i )])* np . mat ( locals
()[ ’P_L_ ’ + str ( i )])* np . mat ( L2 )* np . mat ( R1 )
* np . mat ( locals ()[ ’P_R_ ’ + str ( i )])
70 locals ()[ ’B2_lift ’ + str ( i )] = np . mat ( R4 )
* np . mat ( locals ()[ ’P_R_ ’ + str ( i )])
* np . mat ( locals ()[ ’P_L_ ’ + str ( i )])
* np . mat ( L3 )* np . mat ( R2 )* np . mat ( locals ()
[’P_R_ ’ + str ( i )])* np . mat ( locals ()
75 [’P_L_ ’ + str ( i )])* np . mat ( L1 )
file . wr ite (’lift %d-th boson : \n’% i )
locals ()[ ’B1_lift ’ + str ( i ) + ’_eigen1 ’] ,
locals ()[ ’B1_lift ’ + str ( i ) + ’_eigen2 ’] ,
80 locals ()[ ’B1_lift ’ + str ( i ) + ’_eigen3 ’] ,
locals ()[ ’B1_lift ’ + str ( i ) + ’_eigen4 ’] ,
d = calculate_eigenvalues ( locals ()[ ’B1_lift ’ + str ( i )])
locals ()[ ’B2_lift ’ + str ( i ) + ’_eigen1 ’] ,
locals ()[ ’B2_lift ’ + str ( i ) + ’_eigen2 ’] ,
85 locals ()[ ’B2_lift ’ + str ( i ) + ’_eigen3 ’] ,
locals ()[ ’B2_lift ’ + str ( i ) + ’_eigen4 ’] ,
d = calculate_eigenvalues ( locals ()[ ’B2_lift ’ + str ( i )])
file . wr ite (’eigenvalues for B1:’+ ’ ’
+ str ( locals ()[ ’B1_lift ’ + str ( i )

90 + ’_eigen1 ’])+ ’ ’ + str ( locals ()
[’B1_lift ’ + str ( i ) + ’_eigen2 ’])
+ ’ ’ + str ( locals ()[ ’B1_lift ’
+ str ( i ) + ’_eigen3 ’])+ ’ ’
+ str ( locals ()[ ’B1_lift ’ + str ( i )
95 + ’_eigen4 ’]) + "\n")
file . wr ite (’eigenvalues for B2:’+ ’ ’
+ str ( locals ()[ ’B2_lift ’ + str ( i )
+ ’_eigen1 ’])+ ’ ’ + str ( locals ()
[’B2_lift ’ + str ( i ) + ’_eigen2 ’])
100 + ’ ’ + str ( locals ()[ ’B2_lift ’
+ str ( i ) + ’_eigen3 ’])+ ’ ’
+ str ( locals ()[ ’B2_lift ’ + str ( i )
+ ’_eigen4 ’]) + "\n")
105

#lift (1,2) (1,3) (1,4) (2,3) (2,4) (3,4) bosons
f o r i in (1 ,2 ,3):
f o r j in (2 ,3 ,4):
i f i < j :
110
locals ()[ ’B1_lift ’ + str ( i )+ str ( j )] =
np . mat ( locals ()[ ’P_L_ ’ + str ( i )])
* np . mat ( locals ()[ ’P_L_ ’ + str ( j )])
* np . mat ( L4 )* np . mat ( R3 )* np . mat ( locals ()
115 [’P_R_ ’ + str ( i )])* np . mat ( locals ()
[’P_R_ ’ + str ( j )])* np . mat ( locals ()
[’P_L_ ’ + str ( i )])* np . mat ( locals ()
[’P_L_ ’ + str ( j )])* np . mat ( L2 )* np . mat ( R1 )
* np . mat ( locals ()[ ’P_R_ ’ + str ( i )])
120 * np . mat ( locals ()[ ’P_R_ ’ + str ( j )])
locals ()[ ’B2_lift ’ + str ( i )+ str ( j )] =
np . mat ( R4 )* np . mat ( locals ()[ ’P_R_ ’
+ str ( i )])* np . mat ( locals ()[ ’P_R_ ’
+ str ( j )])* np . mat ( locals ()[ ’P_L_ ’
125 + str ( i )])* np . mat ( locals ()[ ’P_L_ ’
+ str ( j )])* np . mat ( L3 )* np . mat ( R2 )
* np . mat ( locals ()[ ’P_R_ ’ + str ( i )])
* np . mat ( locals ()[ ’P_R_ ’ + str ( j )])
* np . mat ( locals ()[ ’P_L_ ’ + str ( i )])
130 * np . mat ( locals ()[ ’P_L_ ’ + str ( j )])
* np . mat ( L1 )
file . wr ite (’lift (%d, %d) -th bosons : \n’%( i , j ))
135 locals ()[ ’B1_lift ’ + str ( i ) + str ( j ) + ’_eigen1 ’] ,