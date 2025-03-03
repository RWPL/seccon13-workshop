#include <stdio.h>
#include <stdlib.h> 

int init(){
    setvbuf(stdin, NULL, _IONBF, 0);
    setvbuf(stdout, NULL, _IONBF, 0);
    return 0;
}

// You can use arbitrary command if you call this func.
int win(){
    setreuid(0, 0);
    execve("/bin/sh", NULL, NULL);
    return 0;
}

// gets func can input more 0x100 bytes.
int vuln(){
    char buf[0x100];
    printf("Please input your string: ");
    gets(buf);  // vulnerable
    printf("Your input is : %s", buf);
    return 0;
}

int main(){
    init();
    vuln();
    return 0;
}
