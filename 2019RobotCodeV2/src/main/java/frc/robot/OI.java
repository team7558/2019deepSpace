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
  public int LT = 2, RT = 3, LB = 5, RB = 6;
  public int LJX = 0, LJY = 1, RJX = 4, RJY = 5;
  public int BACK = 7, START = 8, PAUSE = 12;

  public Joystick m_driver = new Joystick(0);
  public Joystick m_operator = new Joystick(1);

  public HashMap<Integer, Command>  m_operatorCommands;
  public HashMap<Integer, Command>  m_driverCommands;

  public OI(){
    //add to the hashmaps here 
  }

  public void checkButtons(){
    /*
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
    */
    if (m_operator.getRawButton(A)){
      Robot.m_hatch.release();
    } else {
      Robot.m_hatch.collect();
    }
    
    if (m_operator.getRawAxis(LT) > 0.4){
      Robot.m_intake.intake(Util.checkSpeed(m_operator.getRawAxis(LT), 0.5));
    } else if (m_operator.getRawAxis(RT) > 0.4){
      Robot.m_intake.shoot(Util.checkSpeed(m_operator.getRawAxis(RT), 0.3));
    } else {
      Robot.m_intake.intake(0.04);
    }

    if (m_operator.getRawButton(LB)){
      Robot.m_intake.center(0.75);
    }

    if (m_driver.getRawAxis(LT) > 0.4){
      Robot.m_joyDrive.cancel();
      Robot.m_joyPVision.start();
    } else {
      Robot.m_joyDrive.start();
      Robot.m_joyPVision.cancel();
    }

    if (m_driver.getRawButton(BACK) && m_driver.getRawButton(START) && m_operator.getRawButton(BACK) && m_operator.getRawButton(START)){
      Robot.m_endgame.extend();
    }

    if (m_operator.getRawButton(RB)){
      Robot.m_endgame.retractLittle();
    }

    switch(m_operator.getPOV()){
      case(0):
        Robot.m_arm.goToPreset("HOME");
        break;
      case(90):
        Robot.m_arm.goToPreset("CARGOSHIP");
        break;
      case(180):
        Robot.m_arm.goToPreset("GROUND");
        break;
      case(270):
        Robot.m_arm.goToPreset("ROCKET_1");
        break;
    }

  }

}
