import requests
import random
import time
from datetime import datetime

log_file = "/usr/src/app/interaction_log.txt" 
ctf_urls = {
    "attack": "http://localhost:8081",
    "defend": "http://localhost:8082",
    "report": "http://localhost:8083",
    "final": "http://localhost:8084"
}

def log_action(action, flag):
    with open(log_file, "a") as f:
        timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        f.write(f"[{timestamp}] {action.upper()} FLAG: {flag}\n")

def attack(ctf_url):
    print(f"Simulating attack on {ctf_url}")
    try:
        response = requests.get(f"{ctf_url}/search?name=' OR '1'='1")
        if "flag{" in response.text:
            flag = response.text.split("flag{")[1].split("}")[0]
            log_action("attack", f"flag{{{flag}}}")
    except Exception as e:
        print(f"Attack error: {e}")

def defend(ctf_url):
    print(f"Simulating defend on {ctf_url}")
    try:
        response = requests.post(f"{ctf_url}/patch")
        if "flag{" in response.text:
            flag = response.text.split("flag{")[1].split("}")[0]
            log_action("defend", f"flag{{{flag}}}")
    except Exception as e:
        print(f"Defense error: {e}")

def report(ctf_url):
    print(f"Simulating report on {ctf_url}")
    try:
        response = requests.post(f"{ctf_url}/report", data={"report": "Found SQL injection in login", "keywords": "sql injection"})
        if "flag{" in response.text:
            flag = response.text.split("flag{")[1].split("}")[0]
            log_action("report", f"flag{{{flag}}}")
    except Exception as e:
        print(f"Report error: {e}")

def final(ctf_url):
    print(f"Simulating final multi-role interaction on {ctf_url}")
    # Attempt attack
    try:
        r = requests.get(f"{ctf_url}/search?name=' OR '1'='1")
        if "flag{" in r.text:
            flag = r.text.split("flag{")[1].split("}")[0]
            log_action("final (attack)", f"flag{{{flag}}}")
            return
    except:
        pass

    # Attempt defend
    try:
        r = requests.post(f"{ctf_url}/patch")
        if "flag{" in r.text:
            flag = r.text.split("flag{")[1].split("}")[0]
            log_action("final (defend)", f"flag{{{flag}}}")
            return
    except:
        pass

    # Attempt report
    try:
        r = requests.post(f"{ctf_url}/report", data={"report": "SQL injection issue", "keywords": "sql injection"})
        if "flag{" in r.text:
            flag = r.text.split("flag{")[1].split("}")[0]
            log_action("final (report)", f"flag{{{flag}}}")
            return
    except:
        pass

while True:
    action = random.choice(["attack", "defend", "report", "final"])
    if action == "attack":
        attack(ctf_urls["attack"])
    elif action == "defend":
        defend(ctf_urls["defend"])
    elif action == "report":
        report(ctf_urls["report"])
    elif action == "final":
        final(ctf_urls["final"])

    time.sleep(random.randint(10, 20))

