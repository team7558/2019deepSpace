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
public class Endgame extends Subsystem {

  private DoubleSolenoid m_bigEndGameSolenoid; 
  private DoubleSolenoid m_littleEndGameSolenoid;

  public Endgame(){
    m_bigEndGameSolenoid = new DoubleSolenoid(RobotMap.BIG_ENDGAME_SOLENOID_1, RobotMap.BIG_ENDGAME_SOLENOID_2); 
    m_littleEndGameSolenoid = new DoubleSolenoid(RobotMap.LITTLE_ENDGAME_SOLENOID_1, RobotMap.LITTLE_ENDGAME_SOLENOID_2);
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  public void extend(){
    m_bigEndGameSolenoid.set(DoubleSolenoid.Value.kForward);
    m_littleEndGameSolenoid.set(DoubleSolenoid.Value.kForward);
  }

  public void retractLittle(){
    m_littleEndGameSolenoid.set(DoubleSolenoid.Value.kReverse);
  }

  public void retractAll(){
    m_littleEndGameSolenoid.set(DoubleSolenoid.Value.kReverse);
    m_bigEndGameSolenoid.set(DoubleSolenoid.Value.kReverse);
  }
}
