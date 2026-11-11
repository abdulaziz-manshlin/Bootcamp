import socket
import sys


def grab_banner(target_ip, port):
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.settimeout(3)

    try:
        sock.connect((target_ip, port))

        # Send an HTTP request to web services
        if port in [80, 8080, 8000, 8008, 8888]:
            request = (
                f"HEAD / HTTP/1.1\r\n"
                f"Host: {target_ip}\r\n"
                f"Connection: close\r\n"
                f"\r\n"
            )

            sock.sendall(request.encode())

        # Receive banner
        data = sock.recv(1024)

        if not data:
            return "No banner received"

        banner = data.decode("utf-8", errors="ignore").strip()

        if not banner:
            return "No readable banner"

        # Get the first line of the banner
        first_line = banner.splitlines()[0]

        return first_line

    except socket.timeout:
        return "Timeout"

    except ConnectionRefusedError:
        return "Connection refused"

    except socket.error as error:
        return f"Socket error: {error}"

    finally:
        sock.close()


def main():
    if len(sys.argv) < 3:
        print(f"Usage: python {sys.argv[0]} <target_ip> <port>")
        return

    target_ip = sys.argv[1]

    try:
        port = int(sys.argv[2])

        if port < 1 or port > 65535:
            print("Error: Port must be between 1 and 65535.")
            return

    except ValueError:
        print("Error: Port must be a number.")
        return

    print(f"Connecting to {target_ip}:{port}...")

    banner = grab_banner(target_ip, port)

    print(f"[BANNER] {banner}")


if __name__ == "__main__":
    main()