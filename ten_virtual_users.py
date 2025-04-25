import requests
import random
import time
import threading
from datetime import datetime

# URLs for each CTF instance
CTF_URLS = {
    "attack": "http://localhost:8081/1",
    "defend": "http://localhost:8082/",
    "report": "http://localhost:8083/",
    "final": "http://localhost:8084/"
}

# Flag outputs
FLAGS = {
    "attack": "flag{login_bypassed_successfully}",
    "defend": "flag{patched_sql_vulnerability}",
    "report": "flag{reporting_successful}"
}

def log_action(user, role, flag):
    timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    with open("user_interaction_log.txt", "a") as log_file:
        log_file.write(f"[{timestamp}] {user} => Role: {role.capitalize()} | Flag: {flag}\n")

def perform_action(user_id):
    roles = ["attack", "defend", "report"]
    role = random.choice(roles)

    try:
        if role == "attack":
            res = requests.get(CTF_URLS["attack"], timeout=10)
            log_action(f"VirtualUser{user_id}", role, FLAGS[role])
        elif role == "defend":
            res = requests.post(CTF_URLS["defend"], data={"patch": "true"}, timeout=10)
            log_action(f"VirtualUser{user_id}", role, FLAGS[role])
        elif role == "report":
            res = requests.post(CTF_URLS["report"], data={"report": "SQLi found"}, timeout=10)
            log_action(f"VirtualUser{user_id}", role, FLAGS[role])
    except Exception as e:
        log_action(f"VirtualUser{user_id}", role, "ERROR: " + str(e))

# Simulate 10 virtual users concurrently
threads = []
for i in range(1, 11):
    t = threading.Thread(target=perform_action, args=(i,))
    t.start()
    threads.append(t)
    time.sleep(random.uniform(1, 3))  # slight delay between launches

for t in threads:
    t.join()
