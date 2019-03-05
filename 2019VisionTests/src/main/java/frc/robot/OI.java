/*----------------------------------------------------------------------------*/
/* Copyright (c) 2017-2018 FIRST. All Rights Reserved.                        */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

/**
 * hatch player intake position is 1/A 
 * release hatch is 2/B
 */

package frc.robot;

import edu.wpi.first.wpilibj.Joystick;
import edu.wpi.first.wpilibj.buttons.Button;
import edu.wpi.first.wpilibj.buttons.JoystickButton;
import frc.robot.commands.*;
import frc.robot.Robot;

public class OI {
  public Joystick m_driver = new Joystick(0); 
  public Joystick m_operator = new Joystick(1);
  public int extendEndGameButton = 2; 
  public int shiftGearDown = 5;
  public int shiftGearUp = 6;
  public int throttle = 1; 
  public int turnStick = 4;
  public int playerIntakeHatchButton = 1; 
  public int groundIntakeHatchButton = 2;
  //public int transportHatchButton = 4; //Y
  public int shootHatchButton = 2; 
  public int intakeCargoButton = 5; //LB
  public int shootCargoFrontButton = 0; //A
  public int shootCargoBackButton = 6; //B
  public int shootCargoButton = 3;  

  public OI(){

    Button ob1 = new JoystickButton(m_operator, playerIntakeHatchButton);
    Button ob2 = new JoystickButton(m_operator, intakeCargoButton);
    Button ob3 = new JoystickButton(m_operator, groundIntakeHatchButton);
    Button ob4 = new JoystickButton(m_operator, shootCargoFrontButton);
    Button ob5 = new JoystickButton(m_operator, shootHatchButton);
    Button ob6 = new JoystickButton(m_operator, shootCargoBackButton);
    Button db5 = new JoystickButton(m_driver, shiftGearDown);
    Button db6 = new JoystickButton(m_driver, shiftGearUp);
    //Button ob7 = new JoystickButton(m_operator, transportHatchButton);

    ob1.whenPressed(new CollectHatch());
    ob5.whenPressed(new ReleaseHatch());

    db5.whenPressed(new GearShiftUp());
    db6.whenPressed(new GearShiftDown());
    
    /*
    ob2.whenPressed(new IntakeCargo());        
    ob3.whenPressed(new CollectHatchGround());
    //ob7.whenPressed(new TransportHatch());
    */
    ob1.close();
    ob2.close();
    ob3.close();
    ob4.close();
    ob5.close();
    ob6.close();
    db5.close();
    db6.close();
    //ob7.close();

  }

  public void checkOtherButtons(){
    switch(m_operator.getPOV()){
      case 180:
        Robot.m_arm.changePreset("INTAKE_CARGO");
        break;
      case 90:
        Robot.m_arm.changePreset("SHOOT_CARGO_BACK");
        break;
      case 270:
        Robot.m_arm.changePreset("INTAKE_HATCH_HUMAN");
        CollectHatch collectHatch = new CollectHatch();
        collectHatch.start();
        break;
      case 0:
        Robot.m_arm.changePreset("RELEASE_HATCH");
        ReleaseHatch releaseHatch = new ReleaseHatch();
        releaseHatch.start();
        break;
      default:
        break;
    }
    
    if (m_operator.getRawAxis(2) > 0.01){
      IntakeCargo intakeCargoCommand = new IntakeCargo();
      intakeCargoCommand.start();
    }
    
    if (m_operator.getRawAxis(3) > 0.01){
      ShootCargo shootCargoCommand = new ShootCargo();
      shootCargoCommand.start();
    } 

    if (m_operator.getRawButton(3)){
      Robot.m_arm.changePreset("SHOOT_CARGO_ROCKET");
    }

    if (m_operator.getRawButton(7) && m_operator.getRawButton(8) && m_driver.getRawButton(7) && m_driver.getRawButton(8)){
      ExtendEndGame endgame = new ExtendEndGame();
      endgame.start();
    }

    if (m_operator.getRawButton(5)){
      RetractEndGame retractEndgame = new RetractEndGame();
      retractEndgame.start();
    }

    if (m_operator.getRawButton(4)){
      Robot.m_arm.changePreset("INTAKE_HATCH_GROUND");
      CollectHatch collectHatch = new CollectHatch();
      collectHatch.start();
    }

    if (m_driver.getRawAxis(3) > 0.4){
      VisionTargetAlign track = new VisionTargetAlign();
      track.start();
    }
/*
    if (m_driver.getRawAxis(3) > 0.4){
      Robot.m_joyDrive.setMaxSpeeds(0.3, 0.2);
      GearShiftDown shiftDown = new GearShiftDown();
      shiftDown.start();
    } else {
      Robot.m_joyDrive.setMaxSpeeds(0.75, 0.6);
    }
    */
    
  }

}