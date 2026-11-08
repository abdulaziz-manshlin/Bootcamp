
#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[])
{
    // Check command-line arguments
    if (argc < 3)
    {
        printf("Usage: %s <log_file> <keyword>\n", argv[0]);
        return 1;
    }

    // Open the log file in read mode
    FILE *file = fopen(argv[1], "r");

    if (file == NULL)
    {
        printf("Error: Cannot open file '%s'\n", argv[1]);
        return 1;
    }

    char line[512];
    int line_number = 0;
    int alert_count = 0;

    // Read the log file line by line
    while (fgets(line, sizeof(line), file) != NULL)
    {
        line_number++;

        // Search for the keyword
        if (strstr(line, argv[2]) != NULL)
        {
            alert_count++;

            printf("[ALERT] Line %d: %s", line_number, line);
        }
    }

    // Close the file
    fclose(file);

    // Print final summary
    printf("\n--------------------------------\n");
    printf("Total suspicious records: %d\n", alert_count);
    printf("--------------------------------\n");

    return 0;
}
