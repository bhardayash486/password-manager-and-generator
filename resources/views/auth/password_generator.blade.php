@extends('layouts.app')

@section('title', 'Password Generator - Password Manager & Generator')

@section('page-title', 'Password Generator')

@section('content')

<style>
    /* Generator */
    .generator-container {
        max-width: 650px;
        margin: 0 auto;
    }

    .generator-card {
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 3px 12px rgba(15, 39, 71, 0.06);
    }

    .generator-card h1 {
        margin: 0 0 8px;
        text-align: center;
        color: #243b5f;
        font-size: 26px;
    }

    .generator-description {
        margin: 0 0 25px;
        text-align: center;
        color: #5f6b76;
        font-size: 14px;
    }

    .logo-section {
        text-align: center;
        margin-bottom: 15px;
    }

    .logo-section img {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    /* Password Display */
    .password-display {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
    }

    .password-display input {
        flex: 1;
        min-width: 0;
        padding: 13px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        background-color: #f3f6f8;
        color: #243b5f;
        font-size: 15px;
        font-weight: bold;
        outline: none;
    }

    .copy-btn {
        border: none;
        background-color: #325481;
        color: white;
        padding: 0 18px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 13px;
        font-weight: bold;
    }

    .copy-btn:hover {
        background-color: #243b5f;
    }

    /* Style for Use Password Button */
    .use-btn {
        border: none;
        background-color: #569c54;
        color: white;
        padding: 0 18px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 13px;
        font-weight: bold;
    }

    .use-btn:hover {
        background-color: #478746;
    }

    /* Options */
    .option-group {
        margin-bottom: 20px;
    }

    .option-group label {
        display: block;
        margin-bottom: 8px;
        color: #243b5f;
        font-size: 14px;
        font-weight: bold;
    }

    .length-row {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .length-row input[type="range"] {
        flex: 1;
        accent-color: #325481;
    }

    .length-value {
        min-width: 45px;
        text-align: center;
        padding: 7px 10px;
        background-color: #eef5f8;
        color: #325481;
        border-radius: 6px;
        font-size: 13px;
        font-weight: bold;
    }

    /* Checkboxes */
    .checkbox-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 11px;
        border: 1px solid #e5e7eb;
        border-radius: 7px;
        background-color: #f9fafb;
        cursor: pointer;
    }

    .checkbox-item:hover {
        border-color: #325481;
        background-color: #f3f6f8;
    }

    .checkbox-item input {
        accent-color: #569c54;
    }

    .checkbox-item span {
        color: #5f6b76;
        font-size: 13px;
    }

    /* Generate Button */
    .generate-btn {
        width: 100%;
        border: none;
        background-color: #569c54;
        color: white;
        padding: 13px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 15px;
        font-weight: bold;
        margin-top: 5px;
    }

    .generate-btn:hover {
        background-color: #478746;
    }

    /* Message */
    .generator-message {
        display: none;
        margin-top: 15px;
        padding: 10px;
        border-radius: 6px;
        text-align: center;
        font-size: 13px;
        font-weight: bold;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .generator-card {
            padding: 22px;
        }

        .password-display {
            flex-direction: column;
        }

        .copy-btn,
        .use-btn {
            padding: 11px;
        }

        .checkbox-group {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="generator-container">
    <div class="generator-card">

        <div class="logo-section">
            <img src="/images/pwd_generate.png" alt="Password Generator Icon">
        </div>

        <h1>Generate Strong Password</h1>
        <p class="generator-description">
            Create a strong and secure password using your preferred options.
        </p>

        <!-- Generated Password -->
        <div class="password-display">
            <input type="text" id="generated-password" readonly placeholder="Your password will appear here">
            <button type="button" class="copy-btn" onclick="copyGeneratedPassword()"> Copy </button>
            <button type="button" class="use-btn" onclick="useGeneratedPassword()"> Use Password </button>
        </div>

        <!-- Password Length -->
        <div class="option-group">
            <label for="password-length">Password Length</label>
            <div class="length-row">
                <input type="range" id="password-length" min="8" max="32" value="16" oninput="updateLength()">
                <span class="length-value" id="length-value">16</span>
            </div>
        </div>

        <!-- Character Options -->
        <div class="option-group">
            <label>Character Types</label>

            <div class="checkbox-group">
                <label class="checkbox-item">
                    <input type="checkbox" id="uppercase" checked>
                    <span> Uppercase (A-Z) </span>
                </label>

                <label class="checkbox-item">
                    <input type="checkbox" id="lowercase" checked>
                    <span> Lowercase (a-z) </span>
                </label>

                <label class="checkbox-item">
                    <input type="checkbox" id="numbers" checked>
                    <span> Numbers (0-9) </span>
                </label>

                <label class="checkbox-item">
                    <input type="checkbox" id="symbols" checked>
                    <span> Symbols (!@#$) </span>
                </label>
            </div>
        </div>

        <button type="button" class="generate-btn" onclick="generatePassword()"> Generate Password </button>

        <div id="generator-message" class="generator-message"></div>
    </div>
</div>

<script>
    function updateLength()
    {
        let length = document.getElementById('password-length').value;
        document.getElementById('length-value').innerText = length;
    }

    function generatePassword()
    {
        let length = parseInt(document.getElementById('password-length').value);
        let useUppercase = document.getElementById('uppercase').checked;
        let useLowercase = document.getElementById('lowercase').checked;
        let useNumbers = document.getElementById('numbers').checked;
        let useSymbols = document.getElementById('symbols').checked;

        let uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let lowercase = 'abcdefghijklmnopqrstuvwxyz';
        let numbers = '0123456789';
        let symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';

        let characterSet = '';
        let password = '';

        if (useUppercase)
        {
            characterSet += uppercase;
        }

        if (useLowercase)
        {
            characterSet += lowercase;
        }

        if (useNumbers)
        {
            characterSet += numbers;
        }

        if (useSymbols)
        {
            characterSet += symbols;
        }

        if (characterSet === '')
        {
            showMessage('Select at least one character type.', true);
            return;
        }

        if (useUppercase)
        {
            password += getRandomCharacter(uppercase);
        }

        if (useLowercase)
        {
            password += getRandomCharacter(lowercase);
        }

        if (useNumbers)
        {
            password += getRandomCharacter(numbers);
        }

        if (useSymbols)
        {
            password += getRandomCharacter(symbols);
        }

        while (password.length < length)
        {
            password += getRandomCharacter(characterSet);
        }

        password = secureShuffle(password.split('')).join('');

        document.getElementById('generated-password').value = password;
        showMessage('Strong password generated successfully.', false);
    }

    function copyGeneratedPassword()
    {
        let password = document.getElementById('generated-password').value;

        if (!password)
        {
            showMessage('Generate a password first.', true);
            return;
        }

        navigator.clipboard.writeText(password)
            .then(function() {
                showMessage('Password copied successfully.', false);
            })
            .catch(function() {
                showMessage('Failed to copy password.', true);
            });
    }

    function useGeneratedPassword()
    {
        let password = document.getElementById('generated-password').value;

        if (!password)
        {
            showMessage('Generate a password first.', true);
            return;
        }

        sessionStorage.setItem('generated_password', password);
        window.location.href = "{{ route('passwords.create') }}";
    }

    function showMessage(message, isError)
    {
        let messageBox = document.getElementById('generator-message');

        messageBox.innerText = message;
        messageBox.style.display = 'block';

        if (isError)
        {
            messageBox.style.backgroundColor = '#f8d7da';
            messageBox.style.color = '#721c24';
        }
        else
        {
            messageBox.style.backgroundColor = '#e8f5e9';
            messageBox.style.color = '#237a36';
        }
    }

    function getRandomCharacter(characters)
    {
        let randomArray = new Uint32Array(1);
        crypto.getRandomValues(randomArray);
        return characters[randomArray[0] % characters.length];
    }

    function secureShuffle(array)
    {
        for (let i = array.length - 1; i > 0; i--)
        {
            let randomArray = new Uint32Array(1);
            crypto.getRandomValues(randomArray);
            let j = randomArray[0] % (i + 1);

            [array[i], array[j]] = [array[j], array[i]];
        }

        return array;
    }

    generatePassword();
</script>

@endsection