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
import edu.wpi.first.wpilibj.DigitalInput;

public class OI {
  public Joystick m_driver = new Joystick(1); 
  public Joystick m_operator = new Joystick(0);
  public int shootHatchButton = 1;
  public int extendEndGameButton = 2;
  public int intakeCargoButton = 3;
  public int retractEndGameButton = 5;
  public int shootCargoButton = 4;
  public int shiftGearDown = 5;
  public int shiftGearUp = 6;

  public DigitalInput elbowFrontLimit;

  public OI(){

    Button b1 = new JoystickButton(m_operator, shootHatchButton);
    Button b2 = new JoystickButton(m_operator, extendEndGameButton);
    Button b3 = new JoystickButton(m_operator, intakeCargoButton);
    Button b4 = new JoystickButton(m_operator, retractEndGameButton);
    Button b5 = new JoystickButton(m_driver, shiftGearDown);
    Button b6 = new JoystickButton(m_driver, shiftGearUp);
    //b1.whenPressed(new ShootHatch());
    //b2.whenPressed(new ExtendEndGame());        
    //b3.whenPressed(new IntakeCargo());
    //b4.whenPressed(new RetractEndGame());
    b5.whenPressed(new GearShiftDown());
    b6.whenPressed(new GearShiftUp());

    b1.close();
    b2.close();
    b3.close();
    b4.close();
    b5.close();
    b6.close();

    elbowFrontLimit = new DigitalInput(1);
  }
  // There are a few additional built in buttons you can use. Additionally,
  // by subclassing Button you can create custom triggers and bind those to
  // commands the same as any other Button.

  //// TRIGGERING COMMANDS WITH BUTTONS
  // Once you have a button, it's trivial to bind it to a button in one of
  // three ways:

  // Start the command when the button is pressed and let it run the command
  // until it is finished as determined by it's isFinished method.
  // button.whenPressed(new ExampleCommand());

  // Run the command while the button is being held down and interrupt it once
  // the button is released.
  // button.whileHeld(new ExampleCommand());

  // Start the command when the button is released and let it run the command
  // until it is finished as determined by it's isFinished method.
  // button.whenReleased(new ExampleCommand());
}