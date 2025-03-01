FROM node:23-alpine

RUN apk add --no-cache tzdata coreutils && \
    cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
    echo "Asia/Tokyo" > /etc/timezone && \
    apk del tzdata

RUN rm -f /usr/bin/vi

RUN addgroup -S rwpl && \
    adduser -S -s /sbin/nologin -G rwpl rwpl

WORKDIR /app

COPY flag.txt /flag.txt
COPY package*.json tsconfig.json ./
COPY src/ ./src/
COPY ./views ./views
COPY ./data ./data

RUN chown -R rwpl:rwpl /app

RUN npm install

RUN chmod -R a-w /app

EXPOSE 3000

USER rwpl

CMD ["npm", "start"]
