import React from 'react';
import {createBottomTabNavigator} from '@react-navigation/bottom-tabs';
import ProfileScreen from '../Screens/ProfileScreen';
import DashBoardScreen from '../Screens/DashBoardScreen';
import BranchesScreen from '../Screens/BranchesScreen';
import HomeVisitScreen from '../Screens/HomeVisitScreen';
import {Icon} from 'native-base';
import {Colors, Fonts} from '../constants';
import {TestsStack} from './TestsStack';
import { useTranslation } from 'react-i18next';
const Tabs = createBottomTabNavigator();
export function HomeBottomTabs(props) {
  const  {t} = useTranslation();
  return (
    <Tabs.Navigator
      initialRouteName={'DashBoardScreen'}
      tabBarOptions={{
        activeTintColor: '#011F6A',
        inactiveTintColor: Colors.colorGullGray,
        labelStyle: {
          fontSize: Fonts.size.small,
        },
        style: {
          paddingVertical: 5,
          borderTopWidth: 0,
          backgroundColor: Colors.colorWhite,
          borderTopRightRadius: 20,
          borderTopLeftRadius: 20,
          paddingBottom: 5,
          height: 55,
        },
        keyboardHidesTabBar: true,
      }}>
      <Tabs.Screen
        name="DashBoardScreen"
        component={DashBoardScreen}
        options={{
          tabBarLabel: t('TAB_LABELS:dashboard'),
          tabBarIcon: ({color}) => (
            <Icon
              name="dashboard"
              type="MaterialIcons"
              style={{color: color, fontSize: 20}}
            />
          ),
        }}
      />
      <Tabs.Screen
        name="TestsScreen"
        component={TestsStack}
        options={{
          tabBarLabel: t('TAB_LABELS:tests'),
          tabBarIcon: ({color}) => (
            <Icon
              name="layer-group"
              type="FontAwesome5"
              style={{color: color, fontSize: 20}}
            />
          ),
        }}
      />
      <Tabs.Screen
        name="BranchesScreen"
        component={BranchesScreen}
        options={{
          tabBarLabel: t('TAB_LABELS:branches'),
          tabBarIcon: ({color}) => (
            <Icon
              name="location"
              type="Entypo"
              style={{color: color, fontSize: 20}}
            />
          ),
        }}
      />
      <Tabs.Screen
        name="HomeVisit"
        component={HomeVisitScreen}
        options={{
          tabBarLabel: t('TAB_LABELS:homeVisit'),
          tabBarIcon: ({color}) => (
            <Icon
              name="clinic-medical"
              type="FontAwesome5"
              style={{color: color, fontSize: 20}}
            />
          ),
        }}
      />
      <Tabs.Screen
        name="Profile"
        component={ProfileScreen}
        options={{
          tabBarLabel:t('TAB_LABELS:profile'),
          tabBarIcon: ({color}) => (
            <Icon
              name="account-circle"
              type="MaterialIcons"
              style={{color: color, fontSize: 20}}
            />
          ),
        }}
      />
    </Tabs.Navigator>
  );
}
