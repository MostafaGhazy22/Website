# Create a JavaScript file with the AES encryption and decryption code using CryptoJS
aes_js_content = """
// AES.js implementation using CryptoJS

// Ensure the CryptoJS library is loaded before using this script
function toNumbers(hex) {
    var arr = [];
    hex.replace(/(..)/g, function (byte) {
        arr.push(parseInt(byte, 16));
    });
    return arr;
}

function toHex() {
    var arr = 1 === arguments.length && arguments[0].constructor === Array ? arguments[0] : arguments;
    var hexString = "";
    for (var i = 0; i < arr.length; i++) {
        hexString += (arr[i] < 16 ? "0" : "") + arr[i].toString(16);
    }
    return hexString.toLowerCase();
}

function decryptAES(ciphertext, key, iv) {
    // Create WordArray from hex strings
    var encryptedHex = CryptoJS.lib.WordArray.create(ciphertext);
    var keyHex = CryptoJS.lib.WordArray.create(key);
    var ivHex = CryptoJS.lib.WordArray.create(iv);

    // Decrypt using CryptoJS
    var decrypted = CryptoJS.AES.decrypt(
        { ciphertext: encryptedHex },
        keyHex,
        {
            iv: ivHex,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        }
    );

    // Convert decrypted WordArray to hex string
    return toHex(decrypted.words);
}
"""

# Save the content to a file
file_path = "/mnt/data/aes.js"
with open(file_path, "w") as file:
    file.write(aes_js_content)

file_path
