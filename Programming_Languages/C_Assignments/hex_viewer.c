
#include <stdio.h>

int main(int argc, char *argv[])
{
    // Check if the user provided a file name
    if (argc < 2)
    {
        printf("Usage: %s <filename>\n", argv[0]);
        return 1;
    }

    // Open the file in binary read mode
    FILE *file = fopen(argv[1], "rb");

    if (file == NULL)
    {
        printf("Error: Cannot open file '%s'\n", argv[1]);
        return 1;
    }

    unsigned char buffer[16];
    size_t bytes_read;

    // Read 16 bytes at a time
    while ((bytes_read = fread(buffer, 1, 16, file)) > 0)
    {
        // Print Hexadecimal values
        for (size_t i = 0; i < 16; i++)
        {
            if (i < bytes_read)
                printf("%02X ", buffer[i]);
            else
                printf("   ");
        }

        printf(" | ");

        // Print ASCII representation
        for (size_t i = 0; i < bytes_read; i++)
        {
            if (buffer[i] >= 32 && buffer[i] <= 126)
                printf("%c", buffer[i]);
            else
                printf(".");
        }

        printf("\n");
    }

    // Close the file
    fclose(file);

    return 0;
}