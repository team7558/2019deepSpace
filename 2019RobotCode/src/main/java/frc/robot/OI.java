/*----------------------------------------------------------------------------*/
/* Copyright (c) 2017-2018 FIRST. All Rights Reserved.                        */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot;

import edu.wpi.first.wpilibj.Joystick;
import edu.wpi.first.wpilibj.buttons.Button;
import edu.wpi.first.wpilibj.buttons.JoystickButton;
import frc.robot.commands.*;

public class OI {
  public Joystick m_driver = new Joystick(1); 
  public Joystick m_operator = new Joystick(0);
  public int extendEndGameButton = 2;
  public int shiftGearDown = 5;
  public int shiftGearUp = 6;
  public int throttle = 1; 
  public int turnStick = 4;
  public int playerIntakeHatchButton = 1; 
  public int groundIntakeHatchButton = 3;
  public int shootHatchButton = 5;
  public int intakeCargoButton = 2;
  public int shootCargoButton = 6;
  

  public OI(){

    Button ob1 = new JoystickButton(m_operator, playerIntakeHatchButton);
    Button ob2 = new JoystickButton(m_operator, intakeCargoButton);
    Button ob3 = new JoystickButton(m_operator, groundIntakeHatchButton);
    Button ob4 = new JoystickButton(m_operator, shootCargoButton);
    Button ob5 = new JoystickButton(m_operator, shootHatchButton);
    Button ob6 = new JoystickButton(m_operator, shootCargoButton);
    Button db5 = new JoystickButton(m_driver, shiftGearDown);
    Button db6 = new JoystickButton(m_driver, shiftGearUp);

    ob1.whenPressed(new CollectHatchPlayer());
    ob2.whenPressed(new IntakeCargo());        
    ob3.whenPressed(new CollectHatchGround());
    ob4.whenPressed(new ShootCargo());
    ob5.whenPressed(new ReleaseHatch());
    ob6.whenPressed(new ShootCargo());
    db5.whenPressed(new GearShiftUp());
    db6.whenPressed(new GearShiftDown());

    ob1.close();
    ob2.close();
    ob3.close();
    ob4.close();
    ob5.close();
    ob6.close();
    db5.close();
    db6.close();

  }
  // button.whenPressed(new ExampleCommand());

  // button.whileHeld(new ExampleCommand());

  // button.whenReleased(new ExampleCommand());
}