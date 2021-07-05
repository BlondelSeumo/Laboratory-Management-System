import React, {useEffect, useState} from 'react';
import {NavigationContainer} from '@react-navigation/native';
import {AuthStack} from './AuthStack';
import {HomeBottomTabs} from './HomeBottomTab';
import FlashMessage from 'react-native-flash-message';
import SplashScreen from 'react-native-splash-screen';

export const AppConatiner = ({userData}) => {
  const [isLoading, setIsLoading] = useState(true);
  const [didMount, setDidMount] = useState(false);

  useEffect(() => {
    setDidMount(true);
    setTimeout(() => {
      setIsLoading(false);
      SplashScreen.hide();
    }, 500);
    return () => setDidMount(false);
  }, []);

  if (!didMount) {
    return null;
  }

  return (
    <NavigationContainer>
      {!isLoading && (userData === null ? <AuthStack /> : <HomeBottomTabs />)}
      <FlashMessage position="top" />
    </NavigationContainer>
  );
};
