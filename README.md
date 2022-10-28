# Test of DDD in PHP without framework

The main objective is to code in PHP object a battle game simulation (the card game) whose rules have been simplified:

- 52 cards, simplified by simply using values from 1 to 52
- the cards are shuffled and dealt to 2 players
- each player turns over the first card of his deck, the player with the highest card scores a point
- the game continues until there are no more cards to play
- the name of the winner is displayed

>Note : I tried in this project to follow the concepts of DDD, without framework nor dependancies.

## Use Case
### Play a game
- Output in Cli

Input:

- Name of player one
- Name of player two
- Number of cards to use (default: 52)
- Display the battles (default: false)

Output:

- Designation of the winner
- Number of points for the winner
- Number of points for the loser
- OPTIONAL : list of battles with details of cards played, winner and points accumulated

I added some constraints on the inputs :

- A player's name cannot be empty
- The two players' names must be different
- The number of cards used must be greater than zero
- The number of cards used must be an even number

## How to run

In your CLI at the root of the project :
```sh
// To launch the game, go to
 ./public/index.php
```

### Possible problems at startup

- This project was build based on php 8.1
- The shebang `#!/usr/bin/php -q` on the `index.php` file doesn't match your configuration
- STDIN is not already defined by PHP, see the commented lines in the `index.php` file
- It could be necessary to change the rights on the entrypoint file :
```sh
chmod 755 public/index.php
```
