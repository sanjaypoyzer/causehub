from lxml import html

htmltext = open('policies.php').read()

tree = html.document_fromstring(htmltext)

rows = tree.cssselect('table tr')
data = []
for i,row in enumerate(rows[1:]):
    elems = list(row)
    id = None
    tr = elems[1]
    a = tr[0]
    url = a.get('href')
    id = url.split('=')[1]
    title = a.text_content()
    #print id, title
    data.append({'dreamid': id, 'title': title})

import json
print json.dumps(data, indent=4)

