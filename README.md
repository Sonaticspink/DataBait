# Set Up Guide

1.Open Linux Ubuntu

2.update linux and install git with command
```
sudo apt update
sudo apt install git
sudo apt install composer
sudo apt install php8.3-cli
```


3.configure git on Ubuntu with command
```
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

4.Go to desired directory (Recomended \home\[Username])

5.Clone git with command
```
git clone https://github.com/Sonaticspink/DataBait
```

# How to run and start docker (first time)

1.start docker

2.cd into the directory (DBProject)

3.run 
```
docker run --rm -v $(pwd):/app composer install
./vendor/bin/sail up -d
./vendor/bin/sail npm install
./vendor/bin/sail bun install
```

# How to run the app
1.start docker

2.cd into the directory (DBProject)

3.run
```
./vendor/bin/sail up -d
```
4.after finish and want to stop the docker image
```
./vendor/bin/sail down
```


# How to open code in VScode
1.copy the path in the Ubuntu

<img width="1529" height="805" alt="image" src="https://github.com/user-attachments/assets/525677df-56ee-4868-a407-8f00589c95e8" />
2.in VScode choose open folder

3.paste path that you copy

4.click open folder button



