#include <stdio.h>
#include <string.h>
#include <ctype.h>

typedef enum {
    WEAK,
    MEDIUM,
    STRONG
} PasswordStrength;

PasswordStrength checkPassword(const char password[]){
    int upper = 0;
    int lower = 0;
    int digit = 0;
    int symbol = 0;

    int length = strlen(password);
    for (int i = 0; i < length; i++)
    {
        unsigned char ch = password[i];
        if (isupper(ch)) upper = 1;
        else if (islower(ch)) lower = 1;
        else if (isdigit(ch)) digit = 1;
        else symbol = 1;
    }
    int score = upper + lower + digit + symbol;

    if (length > 8 && score == 4) return STRONG;
    else if (length > 8 && score >= 2) return MEDIUM;
    else  return WEAK;
}

int main(){
    char password[100];
    printf("Enter your password: ");
    scanf("%99s", password);
    PasswordStrength result = checkPassword(password);

    if (result == STRONG) printf("Your Password is Strong\n");
    else if (result == MEDIUM) printf("Your Password is Medium\n");
    else printf("Your Password isWeak\n");
    return 0;
}