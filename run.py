import requests

try:
    r = requests.get(
        'http://fke-prod:1447/ADMINBC/WS/FKETEST/Codeunit/MemberPortal', auth=('fke-admin', 'Administrator#2021!'))
    print(r.text)
except requests.exceptions.ConnectionError:
    print("not connecting")