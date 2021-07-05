import React from 'react';
import {createStackNavigator} from '@react-navigation/stack';
import TestsScreen from '../Screens/Tests/TestsScreen';
import ResultsPdfScreen from '../Screens/Tests/ResultsPdfScreen';
const Stack = createStackNavigator();
export function TestsStack(props) {
  return (
    <Stack.Navigator
      initialRouteName="TestsScreen"
      screenOptions={{headerShown: false}}>
      <Stack.Screen name="TestsScreen" component={TestsScreen} />
      <Stack.Screen name="ResultsPdfScreen" component={ResultsPdfScreen} />
    </Stack.Navigator>
  );
}
