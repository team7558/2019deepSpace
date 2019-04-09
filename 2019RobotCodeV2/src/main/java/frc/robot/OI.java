/*----------------------------------------------------------------------------*/
/* Copyright (c) 2017-2018 FIRST. All Rights Reserved.                        */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot;

import java.util.HashMap;

import edu.wpi.first.wpilibj.Joystick;
import edu.wpi.first.wpilibj.command.*;

/**
 * This class is the glue that binds the controls on the physical operator
 * interface to the commands and command groups that allow control of the robot.
 */
public class OI {

  public int A = 1, B = 2, X = 3, Y = 4;
  public int LT = 1, RT = 2, LB = 3, RB = 4;
  public int LJX = 1, LJY = 2, RJX = 3, RJY = 4;
  public int START = 11, PAUSE = 12;

  public Joystick m_driver = new Joystick(0);
  public Joystick m_operator = new Joystick(1);

  public HashMap<Integer, Command>  m_operatorCommands;
  public HashMap<Integer, Command>  m_driverCommands;

  public OI(){
    //add to the hashmaps here 
  }

  public void checkButtons(){
    for(Integer button : m_operatorCommands.keySet()) {
      if (m_operator.getRawButton(button)){
        m_operatorCommands.get(button).start();
      }
    }
    for(Integer button : m_operatorCommands.keySet()) {
      if (m_operator.getRawButton(button)){
        m_operatorCommands.get(button).start();
      }
    }
  }

}
