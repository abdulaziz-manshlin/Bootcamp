# 🛡️ Cybersecurity Bootcamp

A structured collection of programming assignments, security-focused exercises, and practical projects completed during my **Cybersecurity Bootcamp**.

The repository focuses on applying programming concepts to real-world cybersecurity scenarios, including file analysis, network scanning, authentication, cryptography, secure web development, vulnerability detection, and defensive programming.

---

## 📂 Repository Structure

```text
Bootcamp/
│
├── Programming_Languages/
│   │
│   ├── C_Assignments/
│   │   ├── hex_viewer.c
│   │   ├── log_parser.c
│   │   └── password_checker.c
│   │
│   ├── Python_Assignments/
│   │   ├── port_scanner.py
│   │   ├── banner_grabber.py
│   │   ├── log_analyzer.py
│   │   ├── password_generator_hasher.py
│   │   └── file_integrity_monitor.py
│   │
│   ├── PHP_Assignments/
│   │   ├── rest_api.php
│   │   ├── sqli_defense.php
│   │   ├── secure_upload.php
│   │   └── session_cookie_security.php
│   │
│   └── JavaScript_Assignments/
│       └── dom_xss_demo.html
│
└── README.md
```

> **Note:** The `others/` directory contains local working materials and is intentionally excluded from the Git repository.

---

## 💻 Programming & Security Assignments

### 🔵 C

| Assignment | Description | Security Focus |
|---|---|---|
| **Hexadecimal Viewer** | Reads binary files and displays their hexadecimal and ASCII representation. | File Analysis |
| **Log File Parser** | Searches log files for suspicious keywords and reports matching records. | Log Analysis |
| **Password Checker** | Checks password strength against security requirements. | Password Security |

---

### 🐍 Python

| Assignment | Description | Security Focus |
|---|---|---|
| **Multithreaded Port Scanner** | Scans TCP ports using multiple threads to identify open services. | Network Reconnaissance |
| **Banner Grabber** | Connects to a network service and retrieves its service banner. | Service Enumeration |
| **Automated Log Analyzer** | Detects SQL Injection and Path Traversal patterns in log files. | Threat Detection |
| **Password Generator & SHA-256 Hasher** | Generates secure random passwords and calculates SHA-256 hashes. | Cryptography |
| **File Integrity Monitor** | Monitors files and detects changes using SHA-256 integrity checks. | File Integrity Monitoring |

---

### 🐘 PHP & Web Security

| Assignment | Description | Security Focus |
|---|---|---|
| **REST API Request Handler** | Implements a basic API supporting GET, POST, PUT, and DELETE requests. | Web/API Security |
| **SQL Injection Defense** | Demonstrates the use of PDO Prepared Statements to prevent SQL Injection. | SQL Injection Prevention |
| **Secure File Upload** | Validates uploaded files using size, extension, and MIME-type checks. | File Upload Security |
| **Session & Cookie Security** | Demonstrates secure sessions, HttpOnly cookies, SameSite protection, and session ID regeneration. | Session Security / CSRF / Session Fixation |

---

### 🟨 JavaScript & Web Security

| Assignment | Description | Security Focus |
|---|---|---|
| **DOM-XSS Security Demonstration** | Demonstrates the difference between unsafe `innerHTML` and secure `textContent` when handling user input. | DOM-Based XSS Prevention |

---

## 🔐 Security Concepts Covered

Throughout these assignments, the repository covers practical implementations of:

- 🔎 Network Reconnaissance
- 🌐 TCP Port Scanning
- 🖥️ Service Enumeration
- 📋 Log Analysis
- 🚨 Attack Pattern Detection
- 🔑 Password Security
- 🔐 SHA-256 Hashing
- 🛡️ File Integrity Monitoring
- 🌐 REST API Handling
- 💉 SQL Injection Prevention
- 📁 Secure File Upload Validation
- 🍪 Cookie Security
- 🔒 Session Security
- 🛡️ Session Fixation Prevention
- 🔄 CSRF Mitigation
- ⚠️ DOM-Based XSS
- 🔐 Secure Input Handling
- 🧱 Defensive Programming

---

## 🧪 Practical Testing

The assignments are not only written as theoretical examples. They are tested locally to verify their expected security behavior.

Examples include:

- Testing open and closed TCP ports.
- Identifying service banners.
- Detecting malicious patterns in logs.
- Verifying SHA-256 integrity changes.
- Testing REST API HTTP methods and invalid requests.
- Confirming SQL Injection payloads are safely handled.
- Rejecting malicious file uploads disguised with allowed extensions.
- Verifying `HttpOnly` and `SameSite=Strict` cookie attributes.
- Demonstrating session ID regeneration after authentication.
- Demonstrating DOM-XSS using controlled test payloads.
- Verifying that `textContent` safely renders untrusted input as plain text.

---

## 🧰 Technologies & Tools

### Programming Languages

- C
- Python
- PHP
- JavaScript
- HTML/CSS

### Security & Development Concepts

- TCP/IP Networking
- HTTP
- REST APIs
- Regular Expressions
- Cryptographic Hashing
- Secure File Handling
- Sessions & Cookies
- Input Validation
- Prepared Statements
- DOM Security
- Defensive Programming

### Development Environment

- Windows
- XAMPP
- PHP 8.5
- Git
- GitHub
- PowerShell
- VS Code

---

## 🎯 Purpose

The purpose of this repository is to document my practical learning journey during the **Cybersecurity Bootcamp** and demonstrate the application of programming skills to cybersecurity problems.

The projects emphasize:

> **Learning by building, testing, analyzing, and securing.**

Each assignment is designed to strengthen both programming fundamentals and practical cybersecurity skills.

---

## 📈 Progress

### Phase 1 — Programming & Web Security

**Status: ✅ Completed**

| Area | Status |
|---|---|
| C Assignments | ✅ Completed |
| Python Assignments | ✅ Completed |
| PHP & Web Security | ✅ Completed |
| JavaScript & Web Security | ✅ Completed |

**Total completed assignments: 14**

---

## 👨‍💻 Author

**Abdulaziz Manshlin**

Cybersecurity Graduate & Cybersecurity Learner

GitHub:  
https://github.com/abdulaziz-manshlin

---

## 📌 Disclaimer

These projects are developed for **educational and authorized security-testing purposes** as part of a Cybersecurity Bootcamp.

Network scanning, vulnerability testing, and security experiments should only be performed against systems and networks for which you have explicit authorization.
