import secrets
import string
import hashlib


def generate_password(length):
    characters = (
        string.ascii_letters
        + string.digits
        + string.punctuation
    )

    password = ""

    for _ in range(length):
        password += secrets.choice(characters)

    return password


def calculate_sha256(text):
    encoded_text = text.encode("utf-8")
    hash_value = hashlib.sha256(encoded_text)

    return hash_value.hexdigest()


def main():
    length = 16

    password = generate_password(length)
    password_hash = calculate_sha256(password)

    print("========== Password Generator ==========")
    print(f"Generated Password: {password}")
    print(f"Password Length: {len(password)}")

    print("\n========== SHA-256 Hash ==========")
    print(f"Hash: {password_hash}")
    print(f"Hash Length: {len(password_hash)}")


if __name__ == "__main__":
    main()