import sys
import re


def main():
    if len(sys.argv) < 2:
        print(f"Usage: python {sys.argv[0]} <log_file>")
        return

    log_file = sys.argv[1]

    sql_pattern = re.compile(r"UNION\s+SELECT", re.IGNORECASE)
    traversal_pattern = re.compile(r"\.\./.*etc/passwd", re.IGNORECASE)
    ip_pattern = re.compile(r"^(\d{1,3}(?:\.\d{1,3}){3})")

    sql_count = 0
    traversal_count = 0

    with open(log_file, "r") as file:
        for line_number, line in enumerate(file, start=1):

            ip_match = re.search(ip_pattern, line)
            ip_address = ip_match.group(1) if ip_match else "Unknown"

            if re.search(sql_pattern, line):
                sql_count += 1
                print(
                    f"[ALERT] SQL Injection - "
                    f"Line {line_number} - IP: {ip_address}"
                )

            if re.search(traversal_pattern, line):
                traversal_count += 1
                print(
                    f"[ALERT] Path Traversal - "
                    f"Line {line_number} - IP: {ip_address}"
                )

    total_attacks = sql_count + traversal_count

    print("\n========== Security Summary ==========")
    print(f"Total attacks detected: {total_attacks}")
    print(f"SQL Injection: {sql_count}")
    print(f"Path Traversal: {traversal_count}")
    print("=======================================")


if __name__ == "__main__":
    main()