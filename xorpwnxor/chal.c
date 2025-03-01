#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>

typedef struct Object {
    char name[64];
    char description[128];

    void (*func)(struct Object *);
} Object;

unsigned long key;

void secret_function(Object *obj) {
    (void)obj;
    puts("This is a safe function.");
}

void win(Object *obj) {
    (void)obj;
    system("/bin/sh");
}

void call_func(Object *obj) {
    void (*decoded)(Object *);
    decoded = (void (*)(Object *))(((unsigned long) obj->func) ^ key);
    decoded(obj);
}

Object *create_object() {
    Object *obj = malloc(sizeof(Object));
    if (!obj) {
        exit(1);
    }
    memset(obj, 0, sizeof(Object));
    strncpy(obj->name, "default", sizeof(obj->name)-1);
    obj->func = (void (*)(Object *))(((unsigned long) secret_function) ^ key);
    return obj;
}

void edit_object(Object *obj) {
    printf("Edit description: ");
    gets(obj->description);
}

void rename_object(Object *obj) {
    printf("Rename (input new name): ");
    gets(obj->name);
}

void print_object(Object *obj) {
    printf("Name: ");
    printf(obj->name);
    printf("\n");
    printf("Description: %s\n", obj->description);
}

void delete_object(Object *obj) {
    free(obj);
}

int main() {
    setbuf(stdout, NULL);
    key = rand();

    Object *obj = create_object();
    int choice;

    while (1) {
        printf("\nMenu:\n");
        printf("1. View object\n");
        printf("2. Edit object description\n");
        printf("3. Rename object\n");
        printf("4. Call object's function\n");
        printf("5. Delete object\n");
        printf("6. Allocate new object\n");
        printf("7. Print libc info\n");
        printf("8. Exit\n");
        printf("Choice: ");
        scanf("%d", &choice);
        getchar();
        switch(choice) {
            case 1:
                print_object(obj);
                break;
            case 2:
                edit_object(obj);
                break;
            case 3:
                rename_object(obj);
                break;
            case 4:
                call_func(obj);
                break;
            case 5:
                delete_object(obj);
                break;
            case 6:
                obj = create_object();
                break;
            case 7:
                printf("puts address: %p\n", puts);
                break;
            case 8:
                exit(0);
                break;
            default:
                printf("Invalid choice.\n");
        }
    }
    return 0;
}
