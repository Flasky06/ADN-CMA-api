import React, { useState } from "react";
import {
StyleSheet,
Text,
View,
TouchableOpacity,
Image,
TextInput,
} from "react-native";
import { SafeAreaView } from "react-native-safe-area-context";
import { router } from "expo-router";
import { cmaLogo } from "@/constants/assets";
import Icon from "react-native-vector-icons/MaterialIcons";
import { StatusBar } from "react-native";
import axios from "axios"; // Import Axios
import AsyncStorage from '@react-native-async-storage/async-storage'; // For storing token

const Login = () => {
const [password, setPassword] = useState("");
const [email, setEmail] = useState("");
const [showPassword, setShowPassword] = useState(false);
const [isLoading, setIsLoading] = useState(false);
const [errorMessage, setErrorMessage] = useState("");

const handleLogin = async () => {
setIsLoading(true);
setErrorMessage(""); // Reset any previous error message

try {
// Make API request to login
const response = await axios.post("http://localhost:8000/api/login", {
email,
password,
});

// Check if response is successful
if (response.data.status === "success") {
// Save the token to AsyncStorage
await AsyncStorage.setItem("auth_token", response.data.token);

// Redirect to the home page
router.push("/(tabs)/home");
} else {
setErrorMessage("Invalid login credentials");
}
} catch (error) {
setErrorMessage("An error occurred. Please try again.");
console.error("Login error:", error);
} finally {
setIsLoading(false);
}
};

return (
<SafeAreaView style={styles.safeArea}>
    <StatusBar barStyle="dark-content" backgroundColor="#0cc" translucent={true} />
    <View style={styles.container}>
        <Image source={cmaLogo} style={styles.logo} />
        <Text style={styles.text}>Login to ADN-CMA</Text>

        {/* Display error message */}
        {errorMessage && <Text style={styles.errorText}>{errorMessage}</Text>}

        <TextInput style={styles.emailInput} placeholder="Email" placeholderTextColor="#aaa" value={email}
            onChangeText={setEmail} />

        <View style={styles.passwordContainer}>
            <TextInput style={styles.input} placeholder="Password" placeholderTextColor="#aaa"
                secureTextEntry={!showPassword} value={password} onChangeText={setPassword} />
            <TouchableOpacity onPress={()=> setShowPassword(!showPassword)}
                style={styles.togglePasswordButton}
                >
                <Icon name={showPassword ? "visibility-off" : "visibility" } size={24} color="#aaa" />
            </TouchableOpacity>
        </View>

        <TouchableOpacity onPress={handleLogin} style={[styles.button, isLoading && styles.buttonDisabled]}
            disabled={isLoading}>
            <Text style={styles.buttonText}>{isLoading ? "Logging in..." : "Login"}</Text>
        </TouchableOpacity>

        <TouchableOpacity onPress={()=> router.push("/forgot-password")}
            style={styles.forgotPasswordLink}
            >
            <Text style={styles.forgotPasswordText}>Forgot Password?</Text>
        </TouchableOpacity>
    </View>
</SafeAreaView>
);
};

const styles = StyleSheet.create({
safeArea: {
flex: 1,
backgroundColor: "#fff",
},
container: {
flex: 1,
justifyContent: "center",
alignItems: "center",
padding: 16,
},
logo: {
width: 100,
height: 100,
marginBottom: 20,
},
text: {
color: "#0ccc",
fontSize: 24,
fontWeight: "bold",
textAlign: "center",
marginBottom: 24,
},
emailInput: {
width: "80%",
padding: 12,
borderRadius: 8,
borderWidth: 1,
borderColor: "#0ccc",
marginBottom: 16,
fontSize: 16,
color: "#333",
},
passwordContainer: {
width: "80%",
flexDirection: "row",
alignItems: "center",
borderWidth: 1,
borderColor: "#0ccc",
borderRadius: 8,
marginBottom: 16,
},
input: {
flex: 1,
padding: 12,
fontSize: 16,
color: "#333",
},
togglePasswordButton: {
padding: 12,
},
button: {
backgroundColor: "#0ccc",
borderRadius: 8,
paddingVertical: 12,
marginTop: 20,
width: "80%",
},
buttonDisabled: {
backgroundColor: "#aaa",
},
buttonText: {
color: "#fff",
fontSize: 24,
fontWeight: "bold",
textAlign: "center",
},
forgotPasswordLink: {
marginTop: 12,
},
forgotPasswordText: {
color: "#0ccc",
fontSize: 16,
fontWeight: "bold",
textAlign: "center",
},
errorText: {
color: "red",
fontSize: 16,
marginBottom: 16,
textAlign: "center",
},
});

export default Login;