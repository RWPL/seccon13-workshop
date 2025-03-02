FROM ubuntu:24.04

RUN apt-get update && \
    apt-get install -y socat && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /opt/challenge

COPY chal .
RUN chmod +x chal

EXPOSE 4000

CMD ["socat", "TCP-LISTEN:4000,reuseaddr,fork", "EXEC:./chal"]