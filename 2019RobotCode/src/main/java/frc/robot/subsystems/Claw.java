/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.Subsystem;
import com.ctre.phoenix.motorcontrol.can.WPI_VictorSPX;

import frc.robot.RobotMap;

/**
 * Add your docs here.
 */
public class Claw extends Subsystem {

  private WPI_VictorSPX m_intake_1, m_intake_2, m_suction;

  public Claw(){
    m_intake_1 = new WPI_VictorSPX(RobotMap.INTAKE_1);
    m_intake_2 = new WPI_VictorSPX(RobotMap.INTAKE_2);
    m_suction = new WPI_VictorSPX(RobotMap.HATCH_SUCTION);
  }

  @Override
  public void initDefaultCommand() {
  }

  public void cargoIntake(){
    m_intake_1.set(-0.75);
    m_intake_2.set(0.75);
  }

  public void shootCargo(){
    m_intake_1.set(0.75);
    m_intake_2.set(-0.75);
  }
  public void stopShootCargo(){
    m_intake_1.set(0);
    m_intake_2.set(0);
  }

  public void suckHatch(){
    m_suction.set(1);
  }

  public void releaseHatch(){
    m_suction.set(0);
  }

}
