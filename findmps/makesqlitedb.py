import json
import sqlite3
from sqlobject import *
import sys

dbpath = '/home/john/asf/projects/causehub-dev/causehub.db'
dburi = 'sqlite://'+dbpath

sqlhub.processConnection = connectionForURI(dburi)

class Policy(SQLObject):
    dream_id = StringCol(alternateID=True, unique=True)
    title = StringCol(default=None)

    distances = MultipleJoin('Distance', joinColumn='dream_id')

    #mps = SQLRelatedJoin('MP', intermediateTable='distance', createRelatedTable=False, joinColumn='dream_id', otherColumn='mp_id')


class MP(SQLObject):
    mp_id = StringCol(default=None, alternateID=True, unique=True)
    first_name = StringCol(default=None)
    last_name = StringCol(default=None)
    title = StringCol(default=None)
    constituency = StringCol(default=None)
    party = StringCol(default=None)
    entered_house = StringCol(default=None)
    left_house = StringCol(default=None)
    entered_reason = StringCol(default=None)
    left_reason = StringCol(default=None)
    house = StringCol(default=None)
    gid = StringCol(default=None)

    #policies = SQLRelatedJoin('Policy', intermediateTable='distance', createRelatedTable=False, joinColumn='mp_id', otherColumn='dream_id')


class Distance(SQLObject):

    dream_id = StringCol(default=None)
    mp_id = StringCol(default=None)
    distance = FloatCol()


if __name__ == '__main__':

    Policy.createTable()
    MP.createTable()
    Distance.createTable()

    distdata = []

    conn = sqlite3.connect(dbpath)
    c = conn.cursor()


    for i,dist in enumerate(open('/tmp/pw_cache_dreamreal_distance.txt')):
        dist = eval("("+dist+")")

        distdata.append((dist[0], dist[1], float(dist[8])))
        sql = "insert into distance values (%s, '%s', '%s', %s)" % (i, dist[0], dist[1], float(dist[8]))
        c.execute(sql)
    conn.commit()
    c.close()

        #print Distance(dream_id=dist[0], mp_id=dist[1], distance=float(dist[8]))

    data = json.loads(open('policies.json').read())
    for i in data:
        print Policy(title=i['title'].encode('utf8'), dream_id=i['dreamid'])

    mps = open('MPnames.sql')
    mpfields = [i for i in enumerate(['mp_id', 'first_name', 'last_name', 'title', 'constituency', 'party', 'entered_house', 'left_house', 'entered_reason', 'left_reason', 'person', 'house', 'gid'])]

    lords = []

    for mp in mps:
        mp = eval(mp)
        #for pos, name in mpfields:
        #    print name, mp[pos]
        #if mp[11] != 'lords':
        #    continue
        #if '9999' not in mp[7]:
        #    continue
        lords.append(mp)

    print "There are %s Lords." % len(lords)

    import time
    time.sleep(1)
    for lord in lords:
        mp = MP(mp_id=str(lord[10]), first_name=lord[1], last_name=lord[2])
#    print mp

