        var randomNumber = Math.floor(Math.random() * 99) + 1;
        var guesses = document.querySelector('#guesses');
        var lastResult = document.querySelector('#lastResult');
        var lowOrHi = document.querySelector('#lowOrHi');
        // var remainingG = document.querySelector('#remainingG');
        var userWins = document.querySelector('#wins');
        var userLosses = document.querySelector('#losses');

        var guessSubmit = document.querySelector('.guessSubmit');
        var guessField = document.querySelector('.guessField');
        
        var guessCount = 1;
        var dubs = 0;
        var ls = 0;
        var resetButton = document.querySelector('#reset');
        resetButton.style.display = 'none';
        guessField.focus();
        // console.log(randomNumber);
        // document.getElementById("numberToGuess").innerHTML = randomNumber;
            
        function checkGuess(){
        // alert('I am a placeholder');
            var userGuess = Number(guessField.value);
            if(userGuess > 99 || isNaN(userGuess) === true){
                alert("Invalid Entry: Entry was higher than 99 or was not an integer");
                guessField.value = '';
                return;
            }
            if(guessCount === 1){
                guesses.innerHTML = 'Previous guesses: ';
            }
            guesses.innerHTML += userGuess + ' ';
                if(userGuess === randomNumber){
                    lastResult.innerHTML = 'Congratulations! You got it right!';
                    lastResult.style.backgroundColor = 'green';
                    lowOrHi.innerHTML = ' ';
                    dubs+=1;
                    setGameOver();
                }else if(guessCount === 7){
                    lastResult.innerHTML = 'Sorry, you lost! ';
                    ls+=1;
                    setGameOver();
                }
                //else if(userGuess > 99 || isNaN(userGuess) === true){
                //     lastResult.innerHTML = 'Sorry, that entry is invalid! ';
                //     lastResult.style.backgroundColor = 'green';
                //     guessCount--;
                // }
                else{
                    lastResult.innerHTML = 'Wrong!';
                    lastResult.style.backgroundColor = 'red';
                    if(userGuess < randomNumber){
                        lowOrHi.innerHTML = 'Last guess was too low!';
                    }else if(userGuess > randomNumber){
                        lowOrHi.innerHTML = 'Last guess was too high!';
                    }
                }
                // remaingGuess.innerHTML = guessCount;
                guessCount++;
                guessField.value = ' ';
                guessField.focus();
        }
        
        guessSubmit.addEventListener('click', checkGuess);
        
        function setGameOver(){
            guessField.disabled = true;
            guessSubmit.disabled = true;
            resetButton.style.display = 'inline';
            userWins.innerHTML = "User Wins: " + dubs;
            userLosses.innerHTML = "User Losses: " + ls;
            resetButton.addEventListener('click', resetGame);
        }
        function resetGame(){
            guessCount = 1;
            var resetParas = document.querySelectorAll('.resultParas p');
            for(var i = 0; i < resetParas.length; i++){
                resetParas[i].textContent = '';
            }
            userWins.innerHTML='';
            userLosses.innerHTML='';
            guessField.disabled = false;
            guessSubmit.disabled = false;
            guessField.value = '';
            guessField.focus();
            lastResult.style.backgroundColor = 'white';
            randomNumber = Math.floor(Math.random() * 99) + 1;
    }