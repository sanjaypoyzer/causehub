import sys

from makesqlitedb import MP, Policy, Distance, sqlite3, dbpath

try:
    query = sys.argv[1]
except:
    print "Usage: %s keyword" % sys.argv[0]
    sys.exit(1)

conn = sqlite3.connect(dbpath)
c = conn.cursor()

#sql = "SELECT distance.id,distance.distance from distance WHERE distance.dream_id IN ('1034')"
#sql = "SELECT dream_id from policy WHERE UPPER(policy.title) LIKE UPPER('%%%s%%')" % (query)
#sql = "SELECT distance.mp_id from distance WHERE distance.dream_id IN (SELECT dream_id from policy WHERE UPPER(policy.title) LIKE UPPER('%%%s%%'))" % (query)
#sql = "SELECT distance.mp_id, distance.distance from distance WHERE distance.dream_id IN (SELECT dream_id from policy WHERE UPPER(policy.title) LIKE UPPER('%%%s%%')) ORDER BY distance.distance LIMIT 10" % (query)
sql = "SELECT DISTINCT mp.mp_id,mp.first_name,mp.last_name FROM mp WHERE mp.mp_id IN (SELECT DISTINCT distance.mp_id from distance WHERE distance.dream_id IN (SELECT dream_id from policy WHERE UPPER(policy.title) LIKE UPPER('%%%s%%')) ORDER BY distance.distance LIMIT 10)" % (query)
for i in c.execute(sql):
    print i

#for query in queries:
#
#    searchTerm = "UPPER(%s) LIKE UPPER('%%%s%%')" % ('title', query)
#    for i in Policy.select(searchTerm):
#        print "Policy:", i
#        print "Distances:", i.distances
#        #print "MPs:", i.mps.count()
#        #for j in i.mps:
#        #    print j
#        #print
#
#for mp in MP.select():
#    print mp
