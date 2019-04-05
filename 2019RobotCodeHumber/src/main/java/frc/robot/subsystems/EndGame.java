/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.Subsystem;
import edu.wpi.first.wpilibj.DoubleSolenoid;
import frc.robot.RobotMap;

/**
 * Add your docs here.
 */
public class EndGame extends Subsystem {
  private DoubleSolenoid bigEndGameSolenoid; 
  private DoubleSolenoid littleEndGameSolenoid;
  // Put methods for controlling this subsystem
  // here. Call these from Commands.
  public EndGame(){
    super();
    bigEndGameSolenoid = new DoubleSolenoid(RobotMap.BIG_ENDGAME_SOLENOID_1, RobotMap.BIG_ENDGAME_SOLENOID_2); 
    littleEndGameSolenoid = new DoubleSolenoid(RobotMap.LITTLE_ENDGAME_SOLENOID_1, RobotMap.LITTLE_ENDGAME_SOLENOID_2);
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  public void extend(){
    System.out.println("extended endgame");
    bigEndGameSolenoid.set(DoubleSolenoid.Value.kForward);
    littleEndGameSolenoid.set(DoubleSolenoid.Value.kForward);
  }
  // This should only be called in case of emergency, and not when deploying end game arm
  public void retractLittle(){
    //endGameSolenoid.set(false);
    //bigEndGameSolenoid.set(DoubleSolenoid.Value.kReverse);
    littleEndGameSolenoid.set(DoubleSolenoid.Value.kReverse);
  }

  public void retractAll(){
    littleEndGameSolenoid.set(DoubleSolenoid.Value.kReverse);
    bigEndGameSolenoid.set(DoubleSolenoid.Value.kReverse);
  }
}
