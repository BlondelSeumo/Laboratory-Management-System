import React from 'react';
import SignInScreen from '../Screens/Auth/SignInScreen';
import ForgetCode from '../Screens/Auth/ForgetCode';
import SignUpScreen from '../Screens/Auth/SignUpScreen';
import {createStackNavigator} from '@react-navigation/stack';
const Stack = createStackNavigator();
export function AuthStack(props) {
  return (
    <Stack.Navigator screenOptions={{headerShown: false}}>
      <Stack.Screen name="SignInScreen" component={SignInScreen} />
      <Stack.Screen name="ForgetCode" component={ForgetCode} />
      <Stack.Screen name="SignUpScreen" component={SignUpScreen} />
    </Stack.Navigator>
  );
}
