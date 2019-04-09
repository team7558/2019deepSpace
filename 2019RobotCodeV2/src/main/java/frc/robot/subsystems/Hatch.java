/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.DoubleSolenoid;
import edu.wpi.first.wpilibj.Solenoid;
import edu.wpi.first.wpilibj.command.Subsystem;
import frc.robot.RobotMap;

/**
 * Add your docs here.
 */
public class Hatch extends Subsystem {
  // Put methods for controlling this subsystem
  // here. Call these from Commands.

  private DoubleSolenoid m_hatchExtend, m_hatchHook;

  public Hatch(){
    m_hatchExtend = new DoubleSolenoid(RobotMap.HATCH_EXTEND_SOLENOID_1, RobotMap.HATCH_EXTEND_SOLENOID_2);
    m_hatchHook = new DoubleSolenoid(RobotMap.HATCH_HOOK_SOLENOID_1, RobotMap.HATCH_HOOK_SOLENOID_2);
  }

  public void toggleExtension(){
    if (m_hatchExtend.get() == DoubleSolenoid.Value.kForward){
      retract();
    } else {
      extend();
    }
  }

  public void extend(){
    m_hatchExtend.set(DoubleSolenoid.Value.kForward);
  }

  public void retract(){
    m_hatchExtend.set(DoubleSolenoid.Value.kReverse);
  }

  public void toggleHook(){
    if (m_hatchHook.get() == DoubleSolenoid.Value.kForward){
      collect();
    } else {
      release();
    }
  }

  public void release(){
    m_hatchHook.set(DoubleSolenoid.Value.kForward);
  }

  public void collect(){
    m_hatchHook.set(DoubleSolenoid.Value.kReverse);
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }
}
