import socket
import sys
import time
from concurrent.futures import ThreadPoolExecutor, as_completed


def scan_port(target_ip, port):
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.settimeout(0.5)

    try:
        result = sock.connect_ex((target_ip, port))

        if result == 0:
            return port

    except socket.error:
        return None

    finally:
        sock.close()

    return None


def main():
    if len(sys.argv) < 2:
        print(f"Usage: python {sys.argv[0]} <target_ip>")
        return

    target_ip = sys.argv[1]

    start_port = 1
    end_port = 1024

    print(f"Scanning {target_ip} ports {start_port}-{end_port}...")

    start_time = time.time()

    open_ports = []

    with ThreadPoolExecutor(max_workers=50) as executor:

        futures = [
            executor.submit(scan_port, target_ip, port)
            for port in range(start_port, end_port + 1)
        ]

        for future in as_completed(futures):
            port = future.result()

            if port is not None:
                open_ports.append(port)
                print(f"[OPEN] Port {port}")

    elapsed = time.time() - start_time

    open_ports.sort()

    print("\nScan completed.")
    print(f"Open ports: {open_ports}")
    print(f"Time elapsed: {elapsed:.2f} seconds")


if __name__ == "__main__":
    main()