/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.Subsystem;
import edu.wpi.first.wpilibj.Solenoid;
import frc.robot.RobotMap;

/**
 * Add your docs here.
 */
public class EndGame extends Subsystem {
  private Solenoid endGameSolenoid; 
  // Put methods for controlling this subsystem
  // here. Call these from Commands.
  public EndGame(){
    endGameSolenoid = new Solenoid(RobotMap.END_GAME_SOLENOID); 
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  public void extend(){
    endGameSolenoid.set(true);
  }
  // This should only be called in case of emergency, and not when deploying end game arm
  public void retract(){
    endGameSolenoid.set(false);
  }
}
