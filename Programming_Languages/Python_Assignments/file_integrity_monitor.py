import hashlib
import sys
import time


def calculate_sha256(file_path):
    sha256_hash = hashlib.sha256()

    with open(file_path, "rb") as file:
        while True:
            chunk = file.read(4096)

            if not chunk:
                break

            sha256_hash.update(chunk)

    return sha256_hash.hexdigest()


def main():
    if len(sys.argv) < 2:
        print(f"Usage: python {sys.argv[0]} <file>")
        return

    file_path = sys.argv[1]

    try:
        baseline_hash = calculate_sha256(file_path)
    except FileNotFoundError:
        print(f"Error: File '{file_path}' not found.")
        return

    print("========== File Integrity Monitor ==========")
    print(f"Monitoring: {file_path}")
    print(f"Baseline SHA-256: {baseline_hash}")
    print("Checking every 3 seconds...")
    print("Press Ctrl+C to stop.\n")

    while True:
        time.sleep(3)

        try:
            current_hash = calculate_sha256(file_path)

            if current_hash != baseline_hash:
                print("[CRITICAL ALERT] File integrity violation detected!")
                print(f"Baseline Hash: {baseline_hash}")
                print(f"Current Hash:  {current_hash}")
                break

            print("[OK] File integrity is unchanged.")

        except FileNotFoundError:
            print("[CRITICAL ALERT] Monitored file was deleted!")
            break


if __name__ == "__main__":
    main()